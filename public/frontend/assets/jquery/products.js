$(document).ready(function() {

    var site = {site_url: window.location.protocol+'//' + window.location.host + '/', 
            asset_url: 'uploads/books',
    };

    $('.category').click(function() {
        var data_category = {category: $(this).attr('data-id')};
        searchProducts(data_category);
    });

    $('#input-search').keyup(function() {
        var data_search = {query: $(this).val()};
        searchProducts(data_search);
    });

    searchProducts();

    function gen_html(products) {

         

        var html = '';

        if(products) {

            $.each(products, function(index, data) {
            html += `
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="shop-box-items">
                        <div class="book-thumb center">
                            <a href="${site.site_url}book_details/${data.slug}"><img src="${site.site_url}uploads/books/${data.image ?? 'no_image.png'}" alt="img"></a>
                            <ul class="shop-icon d-grid justify-content-center align-items-center">
                                <li>
                                    <a href="${site.site_url}book_details/${data.slug}"><i class="far fa-eye"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="shop-content">
                            <h3 class="battambang-regular"><a href="${site.site_url}book_details/${data.slug}">${data.title}</a></h3>
                        </div>
                    </div>
                </div>
            `;
            $('#result').empty();
            $(html).appendTo('#result');

            });
            
        } else {
            $('#result').empty();
            var not_found =  `
                <div class="container">
                    <div class="text-center justify-center item-center item-justify-center">
                      <h1>Not Found Product!</h1>
                    </div>
                </div>
            `;
            $(not_found).appendTo('#result');
        }
    }

    

    function searchProducts(filters = []) {

        var search = filters.query;
        var category = filters.category;
        // var brands = filters.brands ?? '';
        
        $.ajax({
            url: site.site_url + 'search',
            type: 'get',
            data: {search, category},
            dataType: 'json',
            success: function(books) {
                if(books.data && books.data != null && books.data != '') {
                    gen_html(books.data);
                } else {
                     gen_html(0)
                }            
            }
        });    
    }
});