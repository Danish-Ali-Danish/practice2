<style>
    .search-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .search-wrapper {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .search-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .search-input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-input {
        border: 2px solid #eee;
        border-radius: 30px;
        padding: 15px 25px;
        padding-right: 50px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: #007bff;
        box-shadow: none;
    }

    .search-icon {
        position: absolute;
        right: 20px;
        color: #666;
    }

    .category-filters {
        padding: 15px 20px;
        background: #f8f9fa;
        border-radius: 0 0 15px 15px;
    }

    .filter-chip {
        display: inline-block;
        padding: 8px 15px;
        margin: 5px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-chip:hover,
    .filter-chip.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }

    .filter-chip i {
        margin-right: 5px;
        font-size: 0.9em;
    }

    .quick-filters {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .quick-filter {
        padding: 5px 12px;
        background: #e9ecef;
        border-radius: 15px;
        font-size: 0.9em;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .quick-filter:hover {
        background: #dee2e6;
    }

    .suggestions {
        margin-top: 0;
        padding: 10px 0;
        border-top: 1px solid #eee;
        background: #fff;
        border-radius: 0 0 15px 15px;
        max-height: 250px;
        overflow-y: auto;
    }

    .suggestion-item {
        padding: 10px 20px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .suggestion-item:hover {
        background: #f8f9fa;
    }

    .suggestion-item strong {
        color: #007bff;
    }

    .suggestion-category {
        font-size: 0.8em;
        color: #666;
        margin-left: 5px;
    }
</style>
<div class="search-wrapper">
    <div class="search-header">
        <div class="search-input-group">
            <input type="text" id="search-input" class="search-input form-control"
                placeholder="Search products, categories, brands..." autocomplete="off">
            <i class="fas fa-search search-icon"></i>
        </div>
    </div>

    <!-- Category filters: always visible when input is focused -->
    <div id="category-filters" class="category-filters d-none">
        {{-- Loaded via AJAX --}}
    </div>

    <!-- Suggestions: shown below categories -->
    <div id="suggestion-box" class="suggestions d-none">
        {{-- Suggestions appear here --}}
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function () {
    let categorySelected = 'all';

    // Load categories on input focus
    $('#search-input').on('focus', function () {
        // Show category filters
        $('#category-filters').removeClass('d-none');

        // Load categories only once
        if ($('#category-filters').is(':empty')) {
            $.ajax({
                url: "{{ route('search.categories') }}",
                method: "GET",
                success: function (categories) {
                    let html = `<div class="filter-chip active" data-category="all">
                        <i class="fas fa-globe"></i> All</div>`;
                    categories.forEach(cat => {
                        html += `<div class="filter-chip" data-category="${cat.slug}">
                            <i class="fas fa-tag"></i> ${cat.name}
                        </div>`;
                    });
                    $('#category-filters').html(html);
                }
            });
        }

        // Show initial prompt in suggestion box
        $('#suggestion-box').removeClass('d-none')
            .html('<div class="text-center text-muted py-2">Start typing to search...</div>');
    });

    // Select category filter
    $(document).on('click', '.filter-chip', function () {
        $('.filter-chip').removeClass('active');
        $(this).addClass('active');
        categorySelected = $(this).data('category');

        // Refresh suggestions based on new category
        $('#search-input').trigger('keyup');
    });

    // Handle search input keyup
    $('#search-input').on('keyup', function () {
        let query = $(this).val().trim();

        if (query.length < 1) {
            $('#suggestion-box').removeClass('d-none')
                .html('<div class="text-center text-muted py-2">Start typing to search...</div>');
            return;
        }

        $.ajax({
            url: "{{ route('search.suggestions') }}",
            method: "GET",
            data: {
                q: query,
                category: categorySelected
            },
            success: function (results) {
                let html = '';
                if (results.length > 0) {
                    results.forEach(item => {
                        html += `<div class="suggestion-item" onclick="window.location='${item.url}'">
                            <div class="fw-semibold">${item.name}</div>
                            <small class="suggestion-category">${item.type}</small>
                        </div>`;
                    });
                } else {
                    html = '<div class="text-center text-muted py-2">No results found</div>';
                }
                $('#suggestion-box').html(html).removeClass('d-none');
            }
        });
    });

    // Hide categories and suggestions on outside click
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#search-input, #category-filters, #suggestion-box').length) {
            $('#category-filters').addClass('d-none');
            $('#suggestion-box').addClass('d-none');
        }
    });
});
</script>
@endpush
