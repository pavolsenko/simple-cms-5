
@if($total_pages > 1)
    <div class="text-center">
        <nav>
            <ul class="pagination">

            @if($current_page == 1)
                <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            @else
                <li><a href="?page={{ $current_page - 1 }}" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            @endif

            @for($ii = 1; $ii <= $total_pages; $ii++)
                @if($ii == $current_page)
                <li class="disabled active"><a>{{ $ii }}</a></li>
                @else
                <li><a href="?page={{ $ii }}">{{ $ii }}</a></li>
                @endif
            @endfor

                @if($current_page == $total_pages)
                    <li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                @else
                    <li><a href="?page={{ $current_page + 1 }}" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                @endif
            </ul>
        </nav>
    </div>
@endif
