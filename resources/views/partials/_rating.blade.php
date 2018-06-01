<div class="star-ratings-sprite"
     title="@if($rating) Rating: {{round($rating, 1)}}/5 hearts @else not rated yet @endif"
     data-toggle="tooltip"
     style="margin-top: -10px;"
>
    <span class="star-ratings-sprite-rating"
          style="width:{{($rating ?: 0)*100/5}}%">
    </span>
</div>
