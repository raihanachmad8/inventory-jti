<?php

class InventoryController
{
    public function dashboard()
    {
        // $inventory = Inventory::all();
        // $response = new InventoryResponse($inventory);
        // $response->render();
        View::renderView('inventory/dashboard');
    }
}
