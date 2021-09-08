<?php

namespace App\Http\Controllers\Reza;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GroceryCrud\Core\GroceryCrud;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{
    public function categories()
    {
        $title = "Categories";
        $crud = $this->_getGroceryCrudEnterprise();

        $crud->setTable('categories');
        $crud->setSubject('Category', 'Categories');
        $crud->unsetColumns(['created_at', 'updated_at']);
        $crud->unsetFields(['created_at', 'updated_at', 'slug']);
        $crud->setFieldUpload('image', 'storage', '../storage');
        $crud->requiredFields(['name', 'image']);
        $crud->callbackBeforeInsert(function($s){
            $s->data['slug'] = Str::slug($s->data['name']);
            $s->data['created_at'] = now();
            $s->data['updated_at'] = now();
            return $s;
        });
        $crud->callbackBeforeUpdate(function($s){
            $s->data['updated_at'] = now();
            return $s;
        });

        $output = $crud->render();

        return $this->_showOutput($output, $title);
    }

    public function articles()
    {
        $title = "Articles";
        $crud = $this->_getGroceryCrudEnterprise();

        $crud->setTable('blogs');
        $crud->setSubject('Article', 'Articles');
        $crud->unsetColumns(['created_at', 'updated_at']);
        $crud->unsetFields(['created_at', 'updated_at', 'slug', 'user_id']);
        $crud->setFieldUpload('image', 'storage', '../storage');
        $crud->requiredFields(['category_id', 'title', 'content', 'image']);
        $crud->callbackBeforeInsert(function($s){
            $s->data['slug'] = Str::slug($s->data['title']);
            $s->data['created_at'] = now();
            $s->data['updated_at'] = now();
            $s->data['user_id'] = Auth::id();
            return $s;
        });
        $crud->callbackBeforeUpdate(function($s){
            $s->data['updated_at'] = now();
            $s->data['user_id'] = Auth::id();
            return $s;
        });
        $crud->setRelation('category_id', 'categories', 'name');
        $crud->setRelation('user_id', 'users', 'name');
        $crud->displayAs([
            'category_id' => 'Category',
            'user_id' => 'Publisher'
        ]);
        $crud->setTexteditor(['content']);

        $output = $crud->render();

        return $this->_showOutput($output, $title);
    }

    /**
     * Get everything we need in order to load Grocery CRUD
     *
     * @return GroceryCrud
     * @throws \GroceryCrud\Core\Exceptions\Exception
     */
    private function _getGroceryCrudEnterprise()
    {
        $database = $this->_getDatabaseConnection();
        $config = config('grocerycrud');

        $crud = new GroceryCrud($config, $database);
        $crud->unsetSettings();

        return $crud;
    }

    /**
     * Grocery CRUD Output
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    private function _showOutput($output, $title)
    {
        if ($output->isJSONResponse) {
            return response($output->output, 200)
                ->header('Content-Type', 'application/json')
                ->header('charset', 'utf-8');
        }

        $css_files = $output->css_files;
        $js_files = $output->js_files;
        $output = $output->output;

        return view('grocery', [
            'output' => $output,
            'css_files' => $css_files,
            'js_files' => $js_files,
            'title' => $title
        ]);
    }

    /**
     * Get database credentials as a Zend Db Adapter configuration
     * @return array[]
     */
    private function _getDatabaseConnection()
    {

        return [
            'adapter' => [
                'driver' => 'Pdo_Mysql',
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => 'utf8'
            ]
        ];
    }
}
