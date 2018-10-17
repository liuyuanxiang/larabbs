<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Models\User;
use App\Models\Link;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Topic $topic,User $user,Link $link)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $topics = $topic->withOrder($request->order)->where('category_id', $category->id)->paginate(20);
        //从缓存中取前6位活跃用户
        $active_users = $user->getActiveUsers();
        // 传参变量话题和分类到模板中
        $links = $link->getAllCached();
        return view('topics.index', compact('topics', 'category','active_users','links'));
    }
}
