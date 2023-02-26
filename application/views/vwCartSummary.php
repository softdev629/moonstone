<div class="card" id="card_display">
    <div class="card-title">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h3 class="heading heading-3 strong-400 mb-0">
                    <span>Summary</span>
                </h3>
            </div>

            <div class="col-lg-6 text-right">
                <span class="badge badge-md badge-pill bg-blue"><?php echo $total_qty; ?> items</span>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table-cart table-cart-review" width="100%">
            <thead>
                <tr>
                    <th class="product-name">Number Plates</th>
                    <th class="product-total text-right">Total</th>
                </tr>
            </thead>
            <tbody>
              <?php
                setlocale(LC_MONETARY, 'en_US');
                $gm=$total_qty=$qtytotalprice=$qtyprice=0;
                $vat=$this->config->item('vat');
                $dvla_price=get_dvla_price();

              foreach($cart_view as $cart_view_val) 
              { 
                $total_qty=$total_qty+$cart_view_val['items'];
                $qtytotalprice=$qtytotalprice+$cart_view_val['qtytotalprice'];
                $qtyprice=$qtyprice+$cart_view_val['qtyprice'];
                
                $is_vat_apply=1;
                if($cart_view_val['plate_type']=='1'){
                    $is_vat_apply=check_vat_apply($cart_view_val['plates_id']);
                }
                $tax=$vat_cost=0;
                $platePrice=$qtytotalprice;
                $perplatePrice=$platePrice;
                $cartPriceobj=total_product_price($cart_view_val['plate_type'],$qtytotalprice,$is_vat_apply);
                $SubplatePrice=$cartPriceobj['SubplatePrice'];
                $totalPrice=$cartPriceobj['totalPrice'];
                $vat_cost=$cartPriceobj['vat_cost'];
        
              ?>
                <tr class="cart_item">
                    <td class="product-name">
                        <?php echo $cart_view_val['number'];?>
                        <strong class="product-quantity">× <?php echo $cart_view_val['items']; ?></strong>
                    </td>
                    <td class="product-total text-right">
                        <span>£<?php echo !empty($SubplatePrice) ? number_format($SubplatePrice, '2') : $SubplatePrice ; ?></span>
                    </td>
                </tr>
              <?php } ?>
            </tbody>

            <tfoot>
                <tr class="cart-subtotal no-border">
                    <th>Subtotal</th>
                    <td class="text-right">
                        <span class="strong-600">£<?php echo !empty($SubplatePrice) ? number_format($SubplatePrice, '2') : $SubplatePrice ; ?></span>
                    </td>
                </tr>
                <?php if($vat_cost>0){ ?>
                <tr class="cart-subtotal no-border">
                    <th>VAT</th>
                    <td class="text-right">
                        <span class="strong-600">£<?php echo !empty($vat_cost) ? number_format($vat_cost, '2') : $vat_cost ; ?></span>
                    </td>
                </tr>
                <?php } ?>
                <tr class="cart-subtotal no-border">
                    <th>DVLA FEE</th>
                    <td class="text-right">
                        <span class="strong-600">£<?php echo !empty($dvla_price) ? number_format($dvla_price, '2') : $dvla_price ; ?></span>
                    </td>
                </tr>
                <tr class="cart-total">
                    <th><span class="strong-600">Total</span></th>
                    <td class="text-right">
                        <strong><span>£<?php echo !empty($totalPrice) ? number_format($totalPrice, '2') : $totalPrice ; ?></span></strong>                        
                    </td>
                </tr>
            </tfoot>
        </table>

        
    </div>
</div>