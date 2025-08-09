
<div class="features-grid row g-3">
                @foreach($features as $feature)
                    <div class="col-6">
                        <div class="feature-card p-3 rounded-3 h-100 bg-white bg-opacity-10 text-white">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper  bg-opacity-20 rounded-circle p-3 me-3">
                                    <i class="{{ $feature['icon'] }} fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold">{{ $feature['title'] }}</h6>
                                    <small class="opacity-75">{{ $feature['description'] }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            