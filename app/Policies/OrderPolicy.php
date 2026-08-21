<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;

class OrderPolicy
{
    /**
     * Determine whether the user can view the order
     */
    public function view(User $user, Order $order): bool
    {
        return $user->id === $order->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the order
     */
    public function update(User $user, Order $order): bool
    {
        return $user->isAdmin() && $user->hasPermission('update_orders');
    }

    /**
     * Determine whether the user can cancel the order
     */
    public function cancel(User $user, Order $order): bool
    {
        if ($user->id === $order->user_id) {
            return in_array($order->status, ['pending', 'confirmed']);
        }

        return $user->isAdmin() && $user->hasPermission('cancel_orders');
    }
}
