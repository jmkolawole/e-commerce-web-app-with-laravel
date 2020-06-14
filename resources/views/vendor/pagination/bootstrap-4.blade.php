
    @if ($paginator->hasPages())
        <div class="col-lg-8 col-md-8 col-sm-7">
            <ul class="pfolio-breadcrumb-list text-center">
                @if ($paginator->onFirstPage())

                @else
                    <li class="float-left prev"><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left" aria-hidden="true"></i>Previous</a>
                    </li>
                @endif


                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active disabled" aria-disabled="true"><a style="color: maroon!important;font-weight: 800!important;">{{$page}}</a></li>

                            @else
                                <li><a href="{{ $url }}">{{$page}}</a></li>

                            @endif
                        @endforeach
                    @endif
                @endforeach


                @if ($paginator->hasMorePages())
                    <li class="float-right next"><a href="{{ $paginator->nextPageUrl() }}">Next<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </li>
                @else


                @endif




            </ul>
        </div>
    @endif
