<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use app\controller\api\LoginController;
use app\controller\api\post\PostController;
use app\controller\UserController;
use Webman\Route;

Route::group('/v1', function () {
    // 登录相关
    Route::post('/login', [LoginController::class, 'login']);

    Route::group('/user', function () {
        Route::get('/hello', [UserController::class, 'hello']);
    });

    Route::group('/post', function () {
        // 文章相关
        Route::get('/filter', [PostController::class, 'filter']);
        Route::get('/list', [PostController::class, 'list']);
        Route::get('/detail', [PostController::class, 'detail']);
        Route::post('/create', [PostController::class, 'create']);
        Route::post('/update', [PostController::class, 'update']);
        Route::post('/delete', [PostController::class, 'delete']);
    });
});

Route::disableDefaultRoute();





