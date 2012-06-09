# Paginate

Normalize an index range from user input

## Use Case 1 (start with an index range)

1. Get the current range from user input (eg from a HTTP header - `Range: items=40-49`)
3. Define the slice (eg run a query with a `LIMIT` expression)

### Usage

    use Sirprize\Paginate\Input\IndexInput;
	use Sirprize\Paginate\Range\IndexRange;

    $i = new IndexInput(4400, 4499); // $offset, $last
    $i->setDefaultNumItems(25)->setMaxItems(100); // set defaults and limits
	$r = new IndexRange($i);
    $q = sprintf("SELECT * FROM my_table LIMIT %d, %d", $r->getOffset(), $r->getNumItems());

## Use Case 2 (start from current page)

1. Get the current page and possibly the number of items per page from user input
2. Define the slice (eg run a query with a `LIMIT` expression)

### Usage

    use Sirprize\Paginate\Input\PageInput;
	use Sirprize\Paginate\Range\PageRange;
    
    $i = new PageInput(45, 100); // $currentPage, $numItemsPerPage
    $i->setDefaultNumItems(25)->setMaxItems(100); // set defaults and limits
	$r = new PageRange($i);
    $q = sprintf("SELECT * FROM my_table LIMIT %d, %d", $r->getOffset(), $r->getNumItems());

## Paginator

1. Perform an action to get the total number of items in a list (eg run a simple query with a `COUNT` expression)
2. Get the current page and possibly the number of items per page from user input
3. Start paginator with user input and number of items
4. Define the slice (eg run a complex query with a `LIMIT` expression)

### Usage

    use Sirprize\Paginate\Input\PageInput;
    use Sirprize\Paginate\Range\PageRange;
    use Sirprize\Paginate\Paginator;
    
    $i = new PageInput(45, 100); // $currentPage, $numItemsPerPage
    $i->setDefaultNumItems(25)->setMaxItems(100); // set defaults and limits
	$r = new PageRange($i);
    $p = new Paginator($r->setTotalItems(189678));
	$p->setBaseUrl('/products')
	$p->setPageParam('p');

### The following information is available:

    echo $p->isOutOfBounds(); // 0
    echo $p->getTotalItems(); // 189678
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
