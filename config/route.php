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

use app\controller\api\city\CityController;
use app\controller\api\company\CompanyController;
use app\controller\api\LoginController;
use app\controller\api\post\PostCommentController;
use app\controller\api\post\PostController;
use app\controller\api\user\UserController;
use Webman\Route;

Route::group('/v1', function () {
    // 登录相关
    Route::post('/login', [LoginController::class, 'login']);

    // 用户相关
    Route::group('/user', function () {
        Route::get('/hot-rank', [UserController::class, 'hotRank']);
    });

    // 城市相关
    Route::group('/city', function () {
        // 城市数据统计
        Route::get('/statistics', [CityController::class, 'statistics']);
    });

    // 公司相关
    Route::group('/company', function () {
        Route::get('/hot-rank', [CompanyController::class, 'hotRank']);
    });

    // 文章相关
    Route::group('/post', function () {
        Route::get('/filter', [PostController::class, 'filter']);
        Route::get('/list', [PostController::class, 'list']);
        Route::get('/detail', [PostController::class, 'detail']);
        Route::post('/create', [PostController::class, 'create']);
        Route::post('/update', [PostController::class, 'update']);
        Route::post('/delete', [PostController::class, 'delete']);
        // 文章评论
        Route::group('/comment', function () {
            Route::get('/list', [PostCommentController::class, 'list']);
            Route::post('/create', [PostCommentController::class, 'create']);
            Route::post('/delete', [PostCommentController::class, 'delete']);
        });
    });
});

Route::disableDefaultRoute();





