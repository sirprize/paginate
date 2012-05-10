# Paginate

All the info you need in your lists.

## Usage

	use Sirprize\Paginate\Paginator;

	$p = new Paginator();
    $p->calculateFromCurrentPage(189678, 45, 100);

	// optional view configuration
	$p->setBaseUrl('/products')->setPageParam('p');

	// get information
	echo $p->getFirstItemOnCurrentPage(); // 4401
	echo $p->getNumPages(); // 1897
	echo $p->getNextPageUrl(); // /products?p=46

The following information is available:

	    [isOutOfBounds] => 0
	    [numItems] => 189678
	    [numItemsPerPage] => 100
	    [numItemsOnCurrentPage] => 100
	    [firstItemOnCurrentPage] => 4401
	    [lastItemOnCurrentPage] => 4500
	    [numPages] => 1897
	    [currentPage] => 45
	    [previousPage] => 44
	    [nextPage] => 46
	    [firstPage] => 1
	    [lastPage] => 1897
	    [offset] => 4400
	    [last] => 4499
	    [currentPageUrl] => /products?p=45
	    [nextPageUrl] => /products?p=46
	    [previousPageUrl] => /products?p=44
	    [firstPageUrl] => /products?p=1
	    [lastPageUrl] => /products?p=1897
	    [baseUrl] => /products
	    [pageParam] => p

## License

See LICENSE.
