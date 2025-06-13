<?php

namespace App\Http\Controllers\Admin;

use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IncomeRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $incomes = Income::whereUserId(auth()->id())->latest()->paginate(5);

        return view('admin.incomes.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $categories = IncomeCategory::whereUserId(auth()->id())->get();
        $currencies = Currency::all();

        return view('admin.incomes.create', compact('categories', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncomeRequest $request): RedirectResponse
    {
        Income::create($request->validated() + [
                'user_id' => auth()->id(),
                'currency_id' => auth()->user()->currency_id,
            ]);

        return redirect()->route('admin.incomes.index')->with([
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
    public function show(Income $income): View
    {
        return view('admin.incomes.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income): View
    {
        $categories = IncomeCategory::whereUserId(auth()->id())->get();
        $currencies = Currency::all();

        return view('admin.incomes.edit', compact('income', 'categories', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IncomeRequest $request, Income $income): RedirectResponse
    {
        $income->update($request->validated() + [
                'user_id' => auth()->id(),
                'currency_id' => auth()->user()->currency_id,
            ]);

        return redirect()->route('admin.incomes.index')->with([
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
    public function destroy(Income $income): RedirectResponse
    {
        $income->delete();

        return redirect()->back()->with([
            'message' => 'success deleted !',
            'alert-info' => 'danger'
        ]);
    }
}
