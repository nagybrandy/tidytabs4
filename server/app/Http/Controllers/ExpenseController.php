<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        return Expense::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $expense = new Expense();
        $expense->name = $request->name;
        $expense->category = $request->category;
        $expense->price = $request->price;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('expenses', 'public');
            $expense->photo = $photoPath;
        }

        $expense->save();

        return response()->json($expense, 201);
    }

    public function show($id)
    {
        return Expense::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'category' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->name = $request->name ?? $expense->name;
        $expense->category = $request->category ?? $expense->category;
        $expense->price = $request->price ?? $expense->price;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('expenses', 'public');
            $expense->photo = $photoPath;
        }

        $expense->save();

        return response()->json($expense);
    }

    public function destroy($id)
    {
        Expense::destroy($id);
        return response()->noContent();
    }
}