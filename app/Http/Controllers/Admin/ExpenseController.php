<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExpenseRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $expenses = Expense::whereUserId(auth()->id())->latest()->paginate(5);

        return view('admin.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $expense_categories = ExpenseCategory::whereUserId(auth()->id())->pluck('name', 'id');
        $currencies = Currency::all();

        return view('admin.expenses.create', compact('expense_categories', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request): RedirectResponse
    {
        Expense::create($request->validated() + [
                'user_id' => auth()->id(),
                'currency_id' => auth()->user()->currency_id,
            ]);

        return redirect()->route('admin.expenses.index')->with([
            'message' => 'success created !',
            'alert-info' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense): View
    {
        return view('admin.expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense): View
    {
        $expense_categories = ExpenseCategory::whereUserId(auth()->id())->pluck('name', 'id');
        $currencies = Currency::all();

        return view('admin.expenses.edit', compact('expense', 'expense_categories', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, Expense $expense): RedirectResponse
    {
        $expense->update($request->validated() + [
                'user_id' => auth()->id(),
                'currency_id' => auth()->user()->currency_id,
            ]);

        return redirect()->route('admin.expenses.index')->with([
            'message' => 'success updated !',
            'alert-info' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense): RedirectResponse
    {
        $expense->delete();

        return redirect()->back()->with([
            'message' => 'success deleted !',
            'alert-info' => 'danger'
        ]);
    }
}
