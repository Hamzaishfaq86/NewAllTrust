@extends('.dashboard.dashboard')

@section('content')
    <!-- Modal -->

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

                <div class="content-wrapper">

                    <!-- FAQ's -->
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="payment" role="tabpanel">
                                <div id="accordionPayment" class="accordion">
                                    @foreach($faqs as $index => $faq)
                                        <div class="card accordion-item {{ $index == 0 ? 'active' : '' }}">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#accordionPayment-{{ $index }}"
                                                        aria-controls="accordionPayment-{{ $index }}"
                                                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}">
                                                    {{ $faq->question }}
                                                </button>
                                            </h2>

                                            <div id="accordionPayment-{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}">
                                                <div class="accordion-body">
                                                    {{ $faq->answer }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /FAQ's -->

                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>

@endsection

@section('script')
    <script src="public/assets/js/tables-datatables-advanced.js"></script>
@endsection
