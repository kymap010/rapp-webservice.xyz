<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\BlogRepository;
use App\Repositories\UserRepository;

use \DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Finding\Services;
use \DTS\eBaySDK\Finding\Types;
use \DTS\eBaySDK\Finding\Enums;
use GuzzleHttp\Promise;    

use AliexApi\Configuration\GenericConfiguration;
use AliexApi\AliexIO;
use AliexApi\Operations\ListProducts;
use AliexApi\Operations\GetProductDetail;

class SearchController extends Controller {

    public $arrayCache = array();
    public $listSearchProducts = array();
    public $exceptionsStore = array();
    public $exceptionsProductId = array();
    public $inputParameters;
    public $outputParameters = null;
    
    public function aliconfig($conf)
    {
        $conf
            ->setApiKey('9123')
            ->setTrackingKey('kymap010')
            ->setDigitalSign('TXYRowgwEuuT');
            return $conf;
    }
  
    
    public function searchAliexpressList()
	{
        if (!isset($_GET['keywords']))
            return null;

        $category = $_GET['category'];
        $sortOrder = $_GET['sortOrder']; 
        $minPrice = $_GET['minPrice']; 
        $maxPrice = $_GET['maxPrice']; 
        $keywords = $_GET['keywords']; 
        $currentPage = $_GET['currentPage'];
        
//        $category = 'None';//$_POST['category'];
//        $sortOrder = 'None';//$_POST['sortOrder']; 
//        $minPrice = '0';//$_POST['minPrice']; 
//        $maxPrice = '0';//$_POST['maxPrice']; 
//        $keywords = 'arduino';//$_POST['keywords']; 
//        $currentPage = '1';//$_POST['currentPage'];
        
        $this->outputParameters = 'productId,productTitle,imageUrl,salePrice,discount,evaluateScore,productUrl';
        
        $this->inputParameters = array (
            'categoryId' => $category,
            'keywords' => null,
            'pageSize' => '40',
            'pageNo' => $currentPage,
            'originalPriceFrom' => $minPrice,
            'originalPriceTo' => $maxPrice,
            'sort' => $sortOrder,
            'highQualityItems' => 'true',
            'localCurrency' => 'RUB',
            'language' => 'ru'
        );
        
        
        $listProductsApi = $this->getListProducts($keywords);  
        if  (!isset($listProductsApi))
            return null;
        if ($listProductsApi['errorCode'] != '20010000')
            return null;
		if ($listProductsApi['result']['totalResults']  == '0')
            return null;
        
        $totalPages = floor(intval($listProductsApi['result']['totalResults']) / 40);
        
        $arrayData = array('curruntPage'=>$currentPage, 'totalPages'=>$totalPages,"items"=>array());
 
            foreach ($listProductsApi['result']['products'] as $product) {       
                $arrayItem = array (
                    'productId' => $product['productId'],
                    'storeName' => null,
                    'productTitle' => $product['productTitle'],
                    'imageUrl' => $product['imageUrl'],
                    'salePrice' => $product['salePrice'],
                    'discount' => $product['discount'],
                    'evaluateScore' => $product['evaluateScore'],
                    'productUrl' => $product['productUrl']
                );
                array_push($arrayData["items"], $arrayItem);     
            }
        
        return json_decode(json_encode($arrayData, true), true);        
        
    }
    
    public function searchAliexpress()
	{
//         $this->inputParameters = array (
//            'categoryId' => 'None',
//            'keywords' => null,
//            'pageSize' => '40',
//            'pageNo' => '1',
//            'originalPriceFrom' => '0',
//            'originalPriceTo' => '0',
//            'sort' => 'sellerRateDown',
//            'highQualityItems' => 'true',
//            'localCurrency' => 'RUB',
//            'language' => 'ru'
//            );
//        
//        $this->listSearchProducts = array (
//            'arduino mega 2560',
//            'arduino uno'
//        );
        
        $this->exceptionsStore = null;
        $this->exceptionsProductId = null;

        //return $this->searchFromOneSeller(); 
        
        if (!isset($_GET['keywords']))
            return null;
        
        $category = $_GET['category'];
        $sortOrder = $_GET['sortOrder']; 
        $minPrice = $_GET['minPrice']; 
        $maxPrice = $_GET['maxPrice']; 
        $keywords = $_GET['keywords']; 
        $currentPage = $_GET['currentPage'];
       
        $this->inputParameters = array (
            'categoryId' => $category,
            'keywords' => null,
            'pageSize' => '40',
            'pageNo' => $currentPage,
            'originalPriceFrom' => $minPrice,
            'originalPriceTo' => $maxPrice,
            'sort' => 'sellerRateDown',
            'highQualityItems' => 'true',
            'localCurrency' => 'RUB',
            'language' => 'ru'
        );
        
        //return $this->searchFromOneSeller(); 
        
        if (isset($_GET['keywords']))
           $this->listSearchProducts = explode(';', $_GET['keywords']); 
        else
            return null;        

        if (isset($_GET['exceptionsStore']))
            $this->exceptionsStore = explode(';', $_GET['exceptionsStore']);
        else
            $this->exceptionsStore = null;
        
        if (isset($_GET['exceptionsProductId']))
            $this->exceptionsProductId = explode(';', $_GET['exceptionsProductId']);
        else
            $this->exceptionsProductId = null;
            
        //return $this->exceptionsProductId;
//        $this->listSearchProducts = array (
//            'arduino mega 2560', 
//            'arduino uno',
//            'arduino nano',
//            'arduino shield'
//        );
//        return $this->listSearchProducts;
//        $this->listSearchProducts = array (
//            'tevo tarantula', 
//            'tevo black widow',
//            'tevo tornado'
//        );        
        
        
//        $this->exceptionsStore = null; //array ('Fruit Pi Store');
//        $this->exceptionsProductId = null; //array ('32517341214');
        
        //dd($this->searchFromOneSeller());
        //return $this->getListProducts('tevo tornado');
        //return $this->getProductArray('32384309919', null, $exceptionsStore);     
        return $this->searchFromOneSeller();     
        //return $this->arrayCache;
    }
    
    public function searchFromOneSeller()
    {
        if (count($this->listSearchProducts) <= 1)
            return null;
        $listFirstProductsApi = $this->getListProducts($this->listSearchProducts['0']);
        if  (!isset($listFirstProductsApi))
            return null;
        if ($listFirstProductsApi['errorCode'] != '20010000')
            return null;
		if ($listFirstProductsApi['result']['totalResults']  == '0')
            return null;	
			
        $listFirstProductsApi = $listFirstProductsApi['result']['products']; 
        
        $arrayResult = array('curruntPage'=>'1', 'totalPages'=>'1',"items"=>array());

        $flag = false;
        
        foreach ($listFirstProductsApi as &$productFirst) { 
            for ($numberProduct = 1; $numberProduct <= count($this->listSearchProducts) - 1; $numberProduct++) { 
                $listNextProductsApi = $this->getListProducts($this->listSearchProducts[$numberProduct]);
                if  (isset($listNextProductsApi))
                {
                    if ($listNextProductsApi['errorCode'] == '20010000')
                    {    
						if ($listNextProductsApi['result']['totalResults']  == '0')
           				   return null;	
                        $listNextProductsApi = $listNextProductsApi['result']['products'];

                            $getProductFirst = $this->getProductArray($productFirst['productId']);
                            if (isset($getProductFirst))
                            {
                                $storeNameFirst = $getProductFirst['storeName'];
                                foreach ($listNextProductsApi as &$productNext) {
                                    $getProductNext = $this->getProductArray($productNext['productId']);
                                    if (isset($getProductNext))
                                    {
                                        $storeNameNext = $getProductNext['storeName'];
                                        if ($storeNameFirst == $storeNameNext)
                                        {
                                            $array = array(
                                                'productId' => $productNext['productId'],
                                                'storeName' => $storeNameNext,
                                                'productTitle' => $getProductNext['productTitle'],
                                                'imageUrl' => $getProductNext['imageUrl'],
                                                'salePrice' => $getProductNext['salePrice'],
                                                'discount' => $getProductNext['discount'],
                                                'evaluateScore' => $getProductNext['evaluateScore'],
                                                'productUrl' => $getProductNext['productUrl']
                                            );           
                                            array_push($arrayResult['items'], $array);
                                            $flag = true;
                                            break;
                                        }else
                                        {
                                            $flag = false;
                                        }
                                    }
                                }
                            }

                    }
                }
                if (!$flag)
                {                                                            
                    $arrayResult = array('curruntPage'=>'1', 'totalPages'=>'1',"items"=>array());//array();
                    break;
                }             
            }
            
            if ($flag)
            {
                $array = array(
                    'productId' => $productFirst['productId'],
                    'storeName' => $storeNameFirst,
                    'productTitle' => $getProductFirst['productTitle'],
                    'imageUrl' => $getProductFirst['imageUrl'],
                    'salePrice' => $getProductFirst['salePrice'],
                    'discount' => $getProductFirst['discount'],
                    'evaluateScore' => $getProductFirst['evaluateScore'],
                    'productUrl' => $getProductFirst['productUrl']
                );           
                array_push($arrayResult['items'], $array);

                return $arrayResult;
            }  
            
        }
        
        return null;     
    }
        
    
    public function getProductArray($productId)
    {        
        if (!$this->compareArray($this->exceptionsProductId, $productId))
        {
            if(isset($this->arrayCache))
            {
                foreach ($this->arrayCache as &$product) {
                    if ($product['productId'] == $productId)
                    {
                        $array = array(
                            'productId' => $product['productId'],
                            'storeName' => $product['storeName'],
                            'productTitle' => $product['productTitle'],
                            'imageUrl' => $product['imageUrl'],
                            'salePrice' => $product['salePrice'],
                            'discount' => $product['discount'],
                            'evaluateScore' => $product['evaluateScore'],
                            'productUrl' => $product['result']['productUrl']
                        );                
                        return $array;
                    }
                }             
            }
            
            $conf = new GenericConfiguration();
            $this->aliconfig($conf);
            $aliexIO = new AliexIO($conf);

            $getproductdetail = new GetProductDetail();
            $getproductdetail->setProductId($productId);
            $getproductdetail->setFields('storeName,productId,productTitle,imageUrl,salePrice,discount,evaluateScore,productUrl');
            $getproductdetail->setLocalCurrency('ru');
            $getproductdetail->setLanguage('ru');
            $formattedResponse = $aliexIO->runOperation($getproductdetail);
            $array = json_decode($formattedResponse, true);

            if ($array['errorCode'] == '20010000')
            {
                if (isset($array['result']))
                {
                    if (isset($array['result']['storeName']))
                    {
                    $storeName = $array['result']['storeName'];
                        if (!$this->compareArray($this->exceptionsStore, $storeName))
                        {   
                            $array = array(
                                'storeName' => $storeName,
                                'productId' => $productId,
                                'productTitle' => $array['result']['productTitle'],
                                'imageUrl' => $array['result']['imageUrl'],
                                'salePrice' => $array['result']['salePrice'],
                                'discount' => $array['result']['discount'],
                                'evaluateScore' => $array['result']['evaluateScore'],
                                'productUrl' => $array['result']['productUrl']
                            );
                            array_push($this->arrayCache, $array);
                            return $array;
                        }
                    }
                }
            }    
        }
        
        return null;       
    }    
    
    public function compareArray($array, $parameter)
    {
        if ($array == null)
            return false;
        
        foreach ($array as &$value) {
            if ($value == $parameter)
                return true;         
        }
        return false;
    }
    
    public function getListProducts($keywords)
    {
        $this->inputParameters['keywords'] = $keywords;
        
        if (empty($this->outputParameters))
            $this->outputParameters = 'productId';

        $conf = new GenericConfiguration();
        $this->aliconfig($conf);
        $aliexIO = new AliexIO($conf);

        $listproducts = new ListProducts();
        
        if ($this->inputParameters['originalPriceFrom'] != '0' && $this->inputParameters['originalPriceTo'] != '0')
        {
            $listproducts->setOriginalPriceFrom($this->inputParameters['originalPriceFrom']);
            $listproducts->setOriginalPriceTo($this->inputParameters['originalPriceTo']);
        }
        if ($this->inputParameters['sort'] != 'None')
        {
            $listproducts->setSort($this->inputParameters['sort']);
        }
        
        $listproducts->setPageNo($this->inputParameters['pageNo']);
        $listproducts->setPageSize($this->inputParameters['pageSize']);
        $listproducts->setFields($this->outputParameters);
        $listproducts->setKeywords($this->inputParameters['keywords']);
        if ($this->inputParameters['categoryId'] != "None")
            $listproducts->setCategoryId($this->inputParameters['categoryId']);
        
        //$listproducts->setHighQualityItems('true');
        //$listproducts->setLocalCurrency('ru');
        //$listproducts->setLanguage('ru');
        $formattedResponse = $aliexIO->runOperation($listproducts);
        $array = json_decode($formattedResponse, true);
    
        return $array;          
    }  
    
    public function getProduct($productId)
    {
        $conf = new GenericConfiguration();
        $this->aliconfig($conf);
        $aliexIO = new AliexIO($conf);

        $getproductdetail = new GetProductDetail();
        $getproductdetail->setProductId($productId);
        $getproductdetail->setFields('storeName,productId,productTitle,imageUrl,salePrice,discount,evaluateScore,productUrl');
        $getproductdetail->setLocalCurrency('ru');
        $getproductdetail->setLanguage('ru');
        $formattedResponse = $aliexIO->runOperation($getproductdetail);
        //return json_decode($formattedResponse, true);
        $array = json_decode($formattedResponse, true);

        return $array;       
    }    
    
    
    //EBAY
    
    
	public function index()
	{
		return view('front.search');
	}
    
	public function searchEbay()
	{
        if (!isset($_GET['keywords']))
            return null;
            
        $category = $_GET['category'];
        $sortOrder = $_GET['sortOrder']; 
        $minPrice = $_GET['minPrice']; 
        $maxPrice = $_GET['maxPrice']; 
        $keywords = $_GET['keywords']; 
        $currentPage = $_GET['currentPage'];    
        
        require ('ebaySDK/ebay-sdk-php-autoloader.php');
        $config = require ('ebaySDK/configuration.php');

        
//        $category = 'None';//$_POST['category'];
//        $sortOrder = 'BestMatch';//$_POST['sortOrder']; 
//        $minPrice = '0';//$_POST['minPrice']; 
//        $maxPrice = '0';//$_POST['maxPrice']; 
//        $keywords = 'computer';//$_POST['keywords']; 
//        $currentPage = '1';//$_POST['currentPage'];

        $service = new Services\FindingService([
            'credentials' => $config['production']['credentials'],
            'globalId'    => Constants\GlobalIds::US
        ]);

        $request = new Types\FindItemsAdvancedRequest();
        $request->keywords = $keywords;
        if ($category !== "None")
            $request->categoryId = [$category];

        if ($sortOrder !== "None")
            $request->sortOrder = $sortOrder; 

        $request->paginationInput = new Types\PaginationInput();
        $request->paginationInput->entriesPerPage = 20;
        $request->paginationInput->pageNumber = (int)$currentPage;

        $request->outputSelector = ['PictureURLLarge', 'GalleryInfo', 'SellerInfo'];


        if ((int)$maxPrice != 0 && (int)$minPrice != 0)
        {
            $request->itemFilter[] = new Types\ItemFilter([
                'name' => 'MinPrice',
                'value' => [$minPrice]
            ]);
            $request->itemFilter[] = new Types\ItemFilter([
                'name' => 'MaxPrice',
                'value' => [$maxPrice]
            ]);
        }

        $response = $service->findItemsAdvanced($request);
        if (isset($response->errorMessage)) {
            foreach ($response->errorMessage->error as $error) {
                printf(
                    "%s: %s\n\n",
                    $error->severity=== Enums\ErrorSeverity::C_ERROR ? 'Error' : 'Warning',
                    $error->message
                );
            }
        }

        //echo $response;
        if ($response->ack !== 'Failure' && $response->paginationOutput->totalEntries != '0') {
            $arrayData = array('curruntPage'=>$currentPage, 'totalPages'=>$response->paginationOutput->totalEntries,"items"=>array());
 
            foreach ($response->searchResult->item as $item) {  

                $LinkImage = $item->pictureURLLarge;
                //$LinkImage = $item->galleryInfoContainer->galleryURL[3]->value;
                if ($LinkImage == '')
                $LinkImage = $item->galleryURL;

                $Price = $item->sellingStatus->currentPrice->value;
                if (isset($item->discountPriceInfo->originalRetailPrice->value))
                {
                    $discountPrice = $item->discountPriceInfo->originalRetailPrice->value; 
                    //echo $Price;
                    $discount = 0;
                    if (!empty($discountPrice) && $discountPrice !== 0)       
                    $discount = 100 - round(($Price * 100)/$discountPrice); 
                }else{
                   $discount = 0; 
                }
                
                $stars = 0;
                $positiveFeedbackPercent = $item->sellerInfo->positiveFeedbackPercent;

                //echo $feedbackScore;
                if (!empty($positiveFeedbackPercent))
                    $stars = floor($positiveFeedbackPercent / 20);

                $arrayItem = array (
                    'productTitle' => $item->title,
                    'imageUrl' => $LinkImage,
                    'salePrice' => $Price,
                    'discount' => $discount,
                    'evaluateScore' => $stars,
                    'productId' => $item->itemId,
                    'productUrl' => $item->viewItemURL,
                    'storeName' => $item->sellerInfo->sellerUserName
                );


                array_push($arrayData["items"], $arrayItem);     
            }
        }
        return json_encode($arrayData, true);
	}
    
    
//	public function language( $lang,
//		ChangeLocale $changeLocale)
//	{		
//		$lang = in_array($lang, config('app.languages')) ? $lang : config('app.fallback_locale');
//		$changeLocale->lang = $lang;
//		$this->dispatch($changeLocale);
//
//		return redirect()->back();
//	}

}
