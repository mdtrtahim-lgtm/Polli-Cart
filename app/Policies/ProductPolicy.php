<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    /**
     * Determine whether the user can create products
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() && $user->hasPermission('create_products');
    }

    /**
     * Determine whether the user can update the product
     */
    public function update(User $user, Product $product): bool
    {
        return $user->isAdmin() && $user->hasPermission('edit_products');
    }

    /**
     * Determine whether the user can delete the product
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->isAdmin() && $user->hasPermission('delete_products');
    }

    /**
     * Determine whether the user can restore the product
     */
    public function restore(User $user, Product $product): bool
    {
        return $user->isAdmin() && $user->hasPermission('restore_products');
    }
}
