<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminOrderBalanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_approving_an_order_credits_the_user_balance_only_once(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['balance' => 10]);
        $order = $this->makeOrder($user);

        $this->actingAs($admin)
            ->put(route('admin.order.update', $order), $this->creditedOrderData('0.00'))
            ->assertRedirect(route('admin.order.list'));

        $this->assertSame('35.50', $user->fresh()->balance);

        $this->actingAs($admin)
            ->put(route('admin.order.update', $order), $this->creditedOrderData('8.25'))
            ->assertRedirect(route('admin.order.list'));

        $this->assertSame('43.75', $user->fresh()->balance);
        $this->assertSame('33.75', $order->fresh()->balance_credit);
        $this->assertSame('25.50', $order->fresh()->balance_credit);
        $this->assertNotNull($order->fresh()->balance_credited_at);

        $this->actingAs($admin)
            ->put(route('admin.order.update', $order), $this->approvedOrderData('25.50'))
            ->assertRedirect(route('admin.order.list'));

        $this->assertSame('35.50', $user->fresh()->balance);
    }

    public function test_my_card_shows_dynamic_card_name_and_credited_amount(): void
    {
        $user = User::factory()->create(['balance' => 30.50]);
        $order = $this->makeOrder($user, [
            'status' => 'approved',
            'card_info_name' => 'Premium Virtual Card',
            'card_number' => '4111 1111 1111 1111',
            'card_holder_name' => 'TEST CUSTOMER',
            'card_expiry' => '12/30',
            'card_cvv' => '123',
            'balance_credit' => '20.50',
            'balance_credited_at' => now(),
        ]);
        $order->product->update([
            'name' => 'Wise MasterCard',
            'image' => 'wise-logo.png',
        ]);

        $this->actingAs($user)
            ->get(route('cards.index'))
            ->assertOk()
            ->assertSee('Premium Virtual Card')
            ->assertSee('Wise MasterCard')
            ->assertSee('uploads/products/wise-logo.png', false)
            ->assertSee('$30.50')
            ->assertSee('$20.50 USD');
    }

    private function makeOrder(User $user, array $attributes = []): Order
    {
        $product = Product::create([
            'name' => 'Virtual Card',
            'price' => '10.00',
            'currency' => 'USD',
            'status' => 'active',
        ]);

        return Order::create(array_merge([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => '1234567890',
            'payment_method' => 'bKash',
            'payment_number' => '01700000000',
            'amount' => '10.00',
            'status' => 'pending',
        ], $attributes));
    }

    private function approvedOrderData(string $balanceCredit): array
    {
        return [
            'status' => 'approved',
            'balance_credit' => $balanceCredit,
            'card_info_name' => 'Payoneer Premium Card',
            'card_number' => '4111 1111 1111 1111',
            'card_holder_name' => 'TEST CUSTOMER',
            'card_expiry' => '12/30',
            'card_cvv' => '123',
        ];
    }

    private function creditedOrderData(string $additionalBalanceCredit): array
    {
        return [
            'status' => 'approved',
            'additional_balance_credit' => $additionalBalanceCredit,
            'card_info_name' => 'Payoneer Premium Card',
            'card_number' => '4111 1111 1111 1111',
            'card_holder_name' => 'TEST CUSTOMER',
            'card_expiry' => '12/30',
            'card_cvv' => '123',
        ];
    }
}
