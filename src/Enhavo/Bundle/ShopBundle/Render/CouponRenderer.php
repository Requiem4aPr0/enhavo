<?php
/**
 * CouponRenderer.php
 *
 * @since 04/09/16
 * @author gseidel
 */

namespace Enhavo\Bundle\ShopBundle\Render;

class CouponRenderer extends AbstractRenderer
{
    public function render($options)
    {
        $resolvedOptions = $this->resolveOptions([
            'template' => 'EnhavoShopBundle:Promotion:coupon.html.twig',
            'cart' => null,
            'immutable' => false
        ], $options);

        $cart = $resolvedOptions['cart'];
        if(empty($cart)) {
            $cart = $this->get('sylius.cart_provider')->getCart();
        }

        $calculator = $this->get('enhavo_shop.calculator.order_composition_calculator');
        $orderComposition = $calculator->calculateOrder($cart);

        return $this->renderTemplate($resolvedOptions['template'], [
            'cart' => $cart,
            'total' => $orderComposition,
            'immutable' => $resolvedOptions['immutable']
        ]);
    }
}