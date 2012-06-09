<?php

/*
 * This file is part of the Paginate package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

require_once __DIR__ . '/../lib/Sirprize/Paginate/Input/AbstractInput.php';
require_once __DIR__ . '/../lib/Sirprize/Paginate/Input/PageInput.php';
require_once __DIR__ . '/../lib/Sirprize/Paginate/Input/IndexInput.php';
require_once __DIR__ . '/../lib/Sirprize/Paginate/Input/RangeHeaderInput.php';
require_once __DIR__ . '/../lib/Sirprize/Paginate/Input/SliceInput.php';

require_once __DIR__ . '/../lib/Sirprize/Paginate/Range/RangeInterface.php';
require_once __DIR__ . '/../lib/Sirprize/Paginate/Range/AbstractRange.php';
require_once __DIR__ . '/../lib/Sirprize/Paginate/Range/PageRange.php';
require_once __DIR__ . '/../lib/Sirprize/Paginate/Range/IndexRange.php';
require_once __DIR__ . '/../lib/Sirprize/Paginate/Range/RangeFactory.php';
require_once __DIR__ . '/../lib/Sirprize/Paginate/Range/SliceRange.php';
require_once __DIR__ . '/../lib/Sirprize/Paginate/Paginator.php';