  <div class="panel panel-default">
      <div class="panel-heading">Order Overview</div>
      <div class="panel-body">
          <table class="table">
            @if(is_null($order->pizzas))
              <?php
                if(is_null($order['pizzas'])){
                  $order = $order->getPizzas();
                }else{
                  $order = $order['pizzas'];
                }
              ?>
              @foreach($order as $pizzaInfo)
                <tr>
                  <td>{{ $pizzaInfo['pizza']->name }}</td>
                  <td>{{ $pizzaInfo['size']->name }}</td>
                  <td>£{{ Basket::getPriceInPounds($pizzaInfo['price']) }}</td>
                </tr>
                @if(count($pizzaInfo['toppings']) > 0)
                  <tr>
                    <td>
                      Toppings:
                    </td>
                    <td>
                        <?php $totalToppingPrice = 0;?>
                        @foreach($pizzaInfo['toppings'] as $topping)
                            {{ $topping['topping']->name }}<br />
                            <?php $totalToppingPrice += $topping['price'] ?>
                        @endforeach
                    </td>
                    <td>
                      £{{ number_format($totalToppingPrice / 100, 2) }}
                    <td>
                  </tr>
                @endif
              @endforeach
            @else
              @foreach($order->pizzas as $pizzaInfo)
                <tr>
                  <td>{{ $pizzaInfo->pizza->name }}</td>
                  <td>{{ $pizzaInfo->size->name }}</td>
                  <td>£{{ Basket::getPriceInPounds($pizzaInfo->price) }}</td>
                </tr>
                @if(count($pizzaInfo->toppings) > 0)
                  <tr>
                    <td>
                      Toppings:
                    </td>
                    <td>
                        <?php $totalToppingPrice = 0;?>
                        @foreach($pizzaInfo->toppings as $topping)
                            {{ $topping->topping->name }}<br />
                            <?php $totalToppingPrice += $topping->price ?>
                        @endforeach
                    </td>
                    <td>
                      £{{ number_format($totalToppingPrice / 100, 2) }}
                    <td>
                  </tr>
                @endif
              @endforeach
            @endif
          </table>
      </div>
    </div>
