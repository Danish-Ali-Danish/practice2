<div class="search-container position-relative">
    <div class="input-group search-box input-group-lg">
        <input type="text" id="global-search" class="form-control rounded-start-pill shadow-sm"
            placeholder="Search products, categories..." autocomplete="off">
        <button class="btn btn-primary rounded-end-pill" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <!-- Category Chips -->
    <div id="category-chips" class="mt-2 d-flex gap-2 flex-wrap" style="display:none;"></div>

    <!-- Suggestions Dropdown -->
    <ul id="search-suggestions" class="list-group position-absolute w-100 shadow-lg z-3 mt-1"
        style="max-height: 350px; overflow-y: auto; display: none;"></ul>
</div>

@push('styles')
<style>
    #search-suggestions li {
        cursor: pointer;
        padding: 10px 15px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: background 0.2s;
    }

    #search-suggestions li.active,
    #search-suggestions li:hover {
        background-color: #0d6efd;
        color: white;
    }

    #search-suggestions img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 5px;
    }

    #category-chips .chip {
        background: #f1f1f1;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.3s;
    }

    #category-chips .chip:hover {
        background-color: #0d6efd;
        color: white;
    }

    #category-chips {
        background-color: white;
        padding: 8px;
        border-radius: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        let selectedIndex = -1;
        const $input = $('#global-search');
        const $suggestions = $('#search-suggestions');
        const $chips = $('#category-chips');

        // Load chips on focus
        $input.on('focus', function () {
            $.get("{{ route('search.categories') }}", function (data) {
                $chips.empty().show();
                data.forEach(cat => {
                    $chips.append(`<div class="chip">${cat.name}</div>`);
                });
            });
        });

        // Hide chips and suggestions on blur (after small delay)
        $input.on('blur', function () {
            setTimeout(() => {
                $chips.hide();
                $suggestions.hide();
            }, 200);
        });

        // Live search
        $input.on('input', function () {
            let query = $(this).val().trim();
            if (query.length === 0) {
                $suggestions.hide();
                return;
            }

            $.get("{{ route('search.suggestions') }}", { q: query }, function (data) {
                $suggestions.empty().show();
                selectedIndex = -1;
                if (data.length === 0) {
                    $suggestions.append(`<li class="list-group-item">No results found</li>`);
                } else {
                    data.forEach(item => {
                        let icon = item.type;
                        let content = '';
                        if (item.type === 'Product') {
                            content = `<img src="${item.image}" alt="">
                                <div>
                                    <strong>${item.name}</strong><br>
                                    <small>${item.description}</small>
                                </div>`;
                        } else {
                            content = `<div><strong>${item.name}</strong> <small class="text-muted">(${item.type})</small></div>`;
                        }

                        $suggestions.append(`<li class="list-group-item" data-url="${item.url}">${content}</li>`);
                    });
                }
            });
        });

        // Keyboard navigation
        $input.on('keydown', function (e) {
            const items = $suggestions.find('li');
            if (e.key === 'ArrowDown') {
                selectedIndex = (selectedIndex + 1) % items.length;
            } else if (e.key === 'ArrowUp') {
                selectedIndex = (selectedIndex - 1 + items.length) % items.length;
            } else if (e.key === 'Enter') {
                if (selectedIndex >= 0 && items.eq(selectedIndex).data('url')) {
                    window.location.href = items.eq(selectedIndex).data('url');
                }
            }
            items.removeClass('active');
            if (selectedIndex >= 0) {
                items.eq(selectedIndex).addClass('active');
            }
        });

        // Click on suggestion
        $(document).on('click', '#search-suggestions li', function () {
            const url = $(this).data('url');
            if (url) window.location.href = url;
        });
    });
</script>
@endpush
