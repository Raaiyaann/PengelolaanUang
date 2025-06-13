<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\CurrencyRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        abort_if(Gate::denies('currency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $currencies = Currency::whereUserId(auth()->id())->latest()->paginate(5);

        return view('admin.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        abort_if(Gate::denies('currency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request): RedirectResponse
    {
        abort_if(Gate::denies('currency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        Currency::create($request->validated() + ['user_id' => auth()->id()]);

        return redirect()->route('admin.currencies.index')->with([
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
    public function show(Currency $currency): View
    {
        abort_if(Gate::denies('currency_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency): View
    {
        abort_if(Gate::denies('currency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, Currency $currency): RedirectResponse
    {
        abort_if(Gate::denies('currency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $currency->update($request->validated() + ['user_id' => auth()->id()]);

        return redirect()->route('admin.currencies.index')->with([
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
    public function destroy(Currency $currency): RedirectResponse
    {
        abort_if(Gate::denies('currency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $currency->delete();

        return redirect()->back()->with([
            'message' => 'success deleted !',
            'alert-info' => 'danger'
        ]);
    }
}
