<?php

namespace App\Http\Controllers\Merchants;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchants\CreateStoreRequest;
use App\Http\Requests\Merchants\UpdateStoreRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateStoreRequest  $request
     * @return App\Http\Resources\StoreResource
     */
    public function store(CreateStoreRequest $request)
    {
        $this->authorize('create', Store::class);
        $store = Store::create($request->all());
        return new StoreResource($store);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateStoreRequest  $request
     * @param  int  $id
     * @return App\Http\Resources\StoreResource
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $this->authorize('update', $store);
        $store->update($request->except(['user_id']));
        return new StoreResource($store->find($store->id));
    }
}
