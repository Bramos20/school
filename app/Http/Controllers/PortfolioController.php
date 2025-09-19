<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(User $student)
    {
        $portfolioItems = $student->portfolioItems()->latest()->get();

        return view('pages.portfolio.index', compact('student', 'portfolioItems'));
    }

    public function create()
    {
        return view('pages.portfolio.create');
    }

    public function store(Request $request, \App\Services\Student\PortfolioService $portfolioService)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'item_type' => 'required|in:file,link',
            'file' => 'required_if:item_type,file|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'url' => 'required_if:item_type,link|url',
        ]);

        $portfolioService->createPortfolioItem($data);

        return back()->with('success', 'Portfolio item added successfully');
    }
}
