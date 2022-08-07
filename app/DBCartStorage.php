<?php

namespace App;

use Darryldecode\Cart\CartCollection;
use App\Models\DBCartModel;

class DBCartStorage
{
    public function has($key)
    {
        return DBCartModel::find($key);
    }

    public function get($key)
    {
        if ($this->has($key)) {
            return new CartCollection(DBCartModel::find($key)->cart_data);
        } else {
            return [];
        }
    }

    public function put($key, $value)
    {
        if ($row = DBCartModel::find($key)) {
            // update
            $row->cart_data = $value;
            $row->save();
        } else {
            DBCartModel::create([
                'id' => $key,
                'cart_data' => $value
            ]);
        }
    }
}
