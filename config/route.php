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
use app\controller\api\post\PostActionController;
use app\controller\api\post\PostCommentController;
use app\controller\api\post\PostController;
use app\controller\api\user\UserController;
use app\middleware\AuthMiddleware;
use Webman\Route;

Route::group('/v1', function () {
    // 登录相关
    Route::post('/login', [LoginController::class, 'login']);
    // 注册
    Route::post('/register', [LoginController::class, 'register']);
    // 注册的验证码
    Route::post('/register-code', [LoginController::class, 'registerCode']);
});

Route::group('/v1', function () {
    // 用户相关
    Route::group('/user', function () {
        // 热度排行版
        Route::get('/hot-rank', [UserController::class, 'hotRank']);
    });

    // 城市相关
    Route::group('/city', function () {
        // 城市数据统计
        Route::get('/statistics', [CityController::class, 'statistics']);
        // 城市 select
        Route::get('/select', [CityController::class, 'select']);
    });

    // 公司相关
    Route::group('/company', function () {
        // 热度排行榜
        Route::get('/hot-rank', [CompanyController::class, 'hotRank']);
        // 下拉接口
        Route::get('/select', [CompanyController::class, 'select']);
    });

    // 文章相关
    Route::group('/post', function () {
        // 查询参数接口
        Route::get('/filter', [PostController::class, 'filter']);
        // 文章列表
        Route::get('/list', [PostController::class, 'list']);
        // 文章详情
        Route::get('/detail', [PostController::class, 'detail']);
        // 创建文章
        Route::post('/create', [PostController::class, 'create']);
        // 更新文章
        Route::post('/update', [PostController::class, 'update']);
        // 删除文章
        Route::post('/delete', [PostController::class, 'delete']);
        // 文章操作
        Route::group('/action', function () {
            // 文章点赞
            Route::post('/like', [PostActionController::class, 'like']);
            // 文章踩
            Route::post('/dislike', [PostActionController::class, 'dislike']);
            // 文章收藏
            Route::post('/star', [PostActionController::class, 'star']);
            // 文章关注
            Route::post('/watch', [PostActionController::class, 'watch']);
        });
        // 文章评论
        Route::group('/comment', function () {
            // 文章评论列表
            Route::get('/list', [PostCommentController::class, 'list']);
            // 发布文章评论
            Route::post('/create', [PostCommentController::class, 'create']);
            // 删除文章评论
            Route::post('/delete', [PostCommentController::class, 'delete']);
        });
    });
})->middleware([
    AuthMiddleware::class,
]);

Route::disableDefaultRoute();





