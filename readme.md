# Paginate

Keep track of indices, items and pages when slicing lists of a known length.

## Use Case 1 (start from current page)

1. Perform an action to get the total number of items in a list (eg run a simple query with a `COUNT` expression)
2. Grab the current page and possibly the number of items per page from user input
3. Start pager with user input
4. Define the slice (eg run a complex query with a `LIMIT` expression)

	use Sirprize\Paginate\CurrentPagePaginator;

	$p = new CurrentPagePaginator(45, 100); // $currentPage, $numItemsPerPage
    $p->start(189678); // $numItems

## Usa Case 2 (start with an index range)

1. Perform an action to get the total number of items in a list (eg run a simple query with a `COUNT` expression)
2. Grab the current range from user input (eg from a HTTP header - `Range: tems=40-49`)
3. Start pager with user input
4. Define the slice (eg run a complex query with a `LIMIT` expression)

	use Sirprize\Paginate\IndexRangePaginator;

	$p = new IndexRangePaginator(4400, 4499); // $offset, $last
    $p->start(189678); // $numItems

## Sugar

	$p->setBaseUrl('/products')
	$p->setPageParam('p');

## The following information is available:

    echo $p->isOutOfBounds(); // 0
    echo $p->getNumItems(); // 189678
    echo $p->getNumItemsPerPage(); // 100
    echo $p->getNumItemsOnCurrentPage(); // 100
    echo $p->getFirstItemOnCurrentPage(); // 4401
    echo $p->getLastItemOnCurrentPage(); // 4500
    echo $p->getNumPages(); // 1897
    echo $p->getCurrentPage(); // 45
    echo $p->getPreviousPage(); // 44
    echo $p->getNextPage(); // 46
    echo $p->getFirstPage(); // 1
    echo $p->getLastPage(); // 1897
    echo $p->getOffset(); // 4400
    echo $p->getLast(); // 4499
    echo $p->getCurrentPageUrl(); // /products?p=45
    echo $p->getNextPageUrl(); // /products?p=46
    echo $p->getPreviousPageUrl(); // /products?p=44
    echo $p->getFirstPageUrl(); // /products?p=1
    echo $p->getLastPageUrl(); // /products?p=1897
    echo $p->getBaseUrl(); // /products
    echo $p->getPageParam(); // p
	
## License

See LICENSE.
