<?php

use Illuminate\Support\Facades\Route;

function test_function()
{
    return 'ok google';
}
if (! function_exists('isActive')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param  string|array $route
     * @param  string       $className
     * @return string
     */
    function isActive($route, $className = 'active')
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $className : '';
        }
        if (Route::currentRouteName() == $route) {
            return $className;
        }
        if (strpos(URL::current(), $route)) {
            return $className;
        }
    }
}


const API_ACCESS_KEY=1;
// User Role Type

const USER_ROLE_ADMIN = 1;
const USER_ROLE_USER = 2;

// ENABLE / DISABLE
const DISABLE = 0;
const ENABLE = 1;


// Status
const STATUS_PENDING = 0;
const STATUS_ACCEPTED = 1;
const STATUS_REJECTED = 2;
const STATUS_SUCCESS = 1;
const STATUS_SUSPENDED = 4;
const STATUS_DELETED = 5;
const STATUS_ALL = 6;
const STATUS_FORCE_DELETED = 7;
const STATUS_USER_DEACTIVATE = 8;

const STATUS_ACTIVE = 1;
const STATUS_DEACTIVE = 0;

const BTC = 1;
const CARD = 2;
const PAYPAL = 3;
const BANK_DEPOSIT = 4;
const STRIPE = 5;
const WALLET_DEPOSIT = 6;
const CRYPTO = 8; // make 8 for ico
const SKRILL = 11;
const PAYSTACK = 9;
const RAZORPAY = 10;


const  SEND_FEES_FIXED  = 1;
const  SEND_FEES_PERCENTAGE  = 2;

//Varification send Type
const Mail = 1;
const PHONE = 2;


const IOS = 1;
const ANDROIND = 2;

// User Activity
const ADDRESS_TYPE_EXTERNAL = 1;
const ADDRESS_TYPE_INTERNAL = 2;

const IMG_PATH = 'uploaded_file/uploads/';
const IMG_VIEW_PATH = 'uploaded_file/uploads/';

const IMG_OTHER_PATH = 'uploaded_file/others/';
const IMG_USER_PATH = 'uploaded_file/users/';
const IMG_ICON_PATH = 'uploaded_file/uploads/coin/';
const IMG_SLEEP_PATH = 'uploaded_file/sleep/';
const IMG_USER_VIEW_PATH = 'uploaded_file/users/';
const IMG_SLEEP_VIEW_PATH = 'uploaded_file/sleep/';
const IMG_USER_VERIFICATION_PATH = 'users/verifications/';
const IMG_NETWORK_LOGO_PATH = 'uploaded_file/network/';

// Gift Card Banner Image Path
const GIFT_CARD_BANNER = 'uploaded_file/gift_card_banner/';

const DISCOUNT_TYPE_FIXED = 1;
const DISCOUNT_TYPE_PERCENTAGE = 2;

const DEPOSIT = 1;
const WITHDRAWAL = 2;

const PAYMENT_TYPE_BTC = 1;
const PAYMENT_TYPE_USD = 2;
const PAYMENT_TYPE_ETH = 3;
const PAYMENT_TYPE_LTC = 4;
const PAYMENT_TYPE_LTCT = 5;
const PAYMENT_TYPE_DOGE = 6;
const PAYMENT_TYPE_BCH = 7;
const PAYMENT_TYPE_DASH = 8;
const PAYMENT_TYPE_USDT = 9;
// plan bonus
const PLAN_BONUS_TYPE_FIXED = 1;
const PLAN_BONUS_TYPE_PERCENTAGE = 2;

//
const CREDIT = 1;
const DEBIT = 2;

//User Activity
const USER_ACTIVITY_LOGIN=1;
const USER_ACTIVITY_MOVE_COIN=2;
const USER_ACTIVITY_WITHDRAWAL=3;
const USER_ACTIVITY_CREATE_WALLET=4;
const USER_ACTIVITY_CREATE_ADDRESS=5;
const USER_ACTIVITY_MAKE_PRIMARY_WALLET=6;
const USER_ACTIVITY_PROFILE_IMAGE_UPLOAD=7;
const USER_ACTIVITY_UPDATE_PASSWORD=8;
const USER_ACTIVITY_UPDATE_EMAIL=12;
const USER_ACTIVITY_ACTIVE=9;
const USER_ACTIVITY_HALF_ACTIVE=10;
const USER_ACTIVITY_INACTIVE=11;
const USER_ACTIVITY_LOGOUT=12;
const USER_ACTIVITY_PROFILE_UPDATE=13;

const DEFAULT_COIN_TYPE="Default";

//wallet types
const PERSONAL_WALLET = 1;
const CO_WALLET = 2;
const COMMAND_TYPE_CACHE = 1;
const COMMAND_TYPE_CONFIG = 2;
const COMMAND_TYPE_ROUTE = 3;
const COMMAND_TYPE_VIEW = 4;
const COMMAND_TYPE_WALLET = 5;
const COMMAND_TYPE_TRADE_FEES = 6;
const COMMAND_TYPE_MIGRATE = 7;
const COMMAND_TYPE_COIN_PAIR = 8;
const COMMAND_TYPE_TOKEN_DEPOSIT = 10;
const COMMAND_TYPE_ADJUST_TOKEN_DEPOSIT = 11;
const COMMAND_TYPE_ERC20_TOKEN_DEPOSIT = 12;
const COMMAND_TYPE_SCHEDULE_START = 13;
const COMMAND_TYPE_DELETE_BUY_ORDER = 14;
const COMMAND_TYPE_DELETE_SELL_ORDER = 15;
const COMMAND_TYPE_DELETE_TRANSACTION = 16;
const COMMAND_TYPE_DELETE_CHART = 17;


//co wallet feature's admin settings
const CO_WALLET_FEATURE_ACTIVE_SLUG = 'co_wallet_feature_active';
const MAX_CO_WALLET_USER_SLUG = 'max_co_wallet_user';
const CO_WALLET_WITHDRAWAL_USER_APPROVAL_PERCENTAGE_SLUG = 'co_wallet_withdrawal_user_approval_percentage';

const CHECK_STATUS = 1;
const CHECK_WITHDRAWAL_STATUS = 2;
const CHECK_WITHDRAWAL_FEES = 3;
const CHECK_MINIMUM_WITHDRAWAL = 4;
const CHECK_MAXIMUM_WITHDRAWAL = 5;

const NOT_DEFINED = 0;
const COIN_PAYMENT = 1;
const BITCOIN_API = 2;
const BITGO_API = 3;
const ERC20_TOKEN = 4;
const BEP20_TOKEN = 5;
const TRC20_TOKEN = 6;
const FIAT_CURREMCY = 7;
const EVM_BASE_COIN = 8;
const SOLONA_BASE_COIN = 10;

const ORDER_TYPE_BUY = 'buy';
const ORDER_TYPE_SELL = 'sell';
const ORDER_TYPE_BUY_SELL = 'buy_sell';

const DASHBOARD_TYPE = 'dashboard';

const GENDER_MALE = 1;
const GENDER_FEMALE = 2;
const GENDER_OTHERS = 3;

const CODE_TYPE_EMAIL = 1;
const CODE_TYPE_PHONE = 2;

const KYC_NOT_SUBMITTED = '';
const KYC_PENDING = 0;
const KYC_APPROVED = 1;
const KYC_REJECTED = 2;

const KYC_NID_REQUIRED = 1;
const KYC_PASSPORT_REQUIRED = 2;
const KYC_DRIVING_REQUIRED = 3;

const PAGE_TYPE_PRODUCT = 1;
const PAGE_TYPE_SERVICE = 2;
const PAGE_TYPE_SUPPORT = 3;

const STRONG_KEY = 'aBf5HIk4aD2lW0Q';

const USDT_OMNILAYER = 'USDT';
const USDT_SOLANA = 'USDT.SOL';
const USDT_TRC20 = 'USDT.TRC20';
const USDT_ERC20 = 'USDT.ERC20';
const USDT_BEP20 = 'USDT.BEP20';

const COIN_USDT = 'USDT';

//faq type
const FAQ_TYPE_MAIN = 1;
const FAQ_TYPE_DEPOSIT = 2;
const FAQ_TYPE_WITHDRAWN = 3;
const FAQ_TYPE_BUY = 4;
const FAQ_TYPE_SELL = 5;
const FAQ_TYPE_COIN = 6;
const FAQ_TYPE_WALLET = 7;
const FAQ_TYPE_TRADE = 8;
const FAQ_TYPE_FIAT_DEPOSIT = 9;
const FAQ_TYPE_P2P = 10;
const FAQ_TYPE_STACKING = 11;
const FAQ_TYPE_GIFT_CARD = 12;

//progress status type
const PROGRESS_STATUS_TYPE_DEPOSIT = 1;
const PROGRESS_STATUS_TYPE_WITHDRAWN = 2;

//kyc list
const KYC_PHONE_VERIFICATION = 1;
const KYC_EMAIL_VERIFICATION = 2;
const KYC_NID_VERIFICATION = 3;
const KYC_PASSPORT_VERIFICATION = 4;
const KYC_DRIVING_VERIFICATION = 5;
const KYC_VOTERS_CARD_VERIFICATION = 6;

//exchange page layout view
const EXCHANGE_LAYOUT_ONE = 1;
const EXCHANGE_LAYOUT_TWO = 2;

// Two Factor Authentication
const GOOGLE_AUTH = 1;
const EMAIL_AUTH = 2;
const PHONE_AUTH = 3;

//status online
const STATUS_OFF_ONLINE = 0;
const STATUS_ONLINE = 1;

// custom page link type
const CUSTOM_PAGE_LINK_PAGE = 1;
const CUSTOM_PAGE_LINK_URL = 2;

//webhook type
const WEBHOOK_TYPE_TRANSFER = 'transfer';
const WEBHOOK_TYPE_TRANSACTION = 'transaction';
const WEBHOOK_TYPE_PENDING_APPROVAL = 'pendingapproval';
const WEBHOOK_TYPE_ADDRESS_CONFIRM = 'address_confirmation';
const WEBHOOK_TYPE_LOW_FEE = 'lowFee';

// check deposit
const CHECK_DEPOSIT = 1;
const ADJUST_DEPOSIT = 2;

//  Fiat Withdraw type
const Fiat_Withdraw_PERCENT = 1;
const Fiat_Withdraw_FIXED = 2;

//display link or text
const SHOW_LINK = 1;
const SHOW_TEXT = 2;

// estimate fee
const TRC20ESTFEE = 15;
const ENERGYSUN = 440;

//token receive type
const TYPE_DEPOSIT=1;
const TYPE_BUY=2;

//captcha
const CAPTCHA_TYPE_DISABLE = 0;
const CAPTCHA_TYPE_RECAPTCHA = 1;
const CAPTCHA_TYPE_GEETESTCAPTCHA = 2;

//kyc type
const KYC_TYPE_DISABLE = 0;
const KYC_TYPE_MANUAL = 1;
const KYC_TYPE_PERSONA = 2;

//referral type
const REFERRAL_TYPE_WITHDRAWAL = 1;
const REFERRAL_TYPE_TRADE = 2;

//email template number
const EMAIL_TEMPLATE_NUMBER_ONE = 1;
const EMAIL_TEMPLATE_NUMBER_TWO = 2;
const EMAIL_TEMPLATE_NUMBER_THREE = 3;
const EMAIL_TEMPLATE_NUMBER_FOUR =4 ;

//sms type
const SMS_TYPE_DISABLE = 0;
const SMS_TYPE_TWILIO = 1;
const SMS_TYPE_NEXMO = 2;
const SMS_TYPE_AFRICA_TALK = 3;

//staking terms type
const STAKING_TERMS_TYPE_STRICT = 1;
const STAKING_TERMS_TYPE_FLEXIBLE = 2;

//staking investment status
const STAKING_INVESTMENT_STATUS_RUNNING = 1;
const STAKING_INVESTMENT_STATUS_CANCELED = 2;
const STAKING_INVESTMENT_STATUS_UNPAID = 3;
const STAKING_INVESTMENT_STATUS_PAID = 4;
const STAKING_INVESTMENT_STATUS_SUCCESS = 5;

//auto renew
const STAKING_IS_NOT_AUTO_RENEW = 1;
const STAKING_IS_AUTO_RENEW = 2;

//user profile delete request status
const USER_DELETE_REQUEST_STATUS_PENDING = 1;
const USER_DELETE_REQUEST_STATUS_ACCEPTED = 2;
const USER_DELETE_REQUEST_STATUS_REJECTED = 3;

//wallet type
const SPOT_TRADE = 1;
const FUTURE_TRADE = 2;

//trade order type
const LIMIT_ORDER = 1;
const MARKET_ORDER = 2;
const STOP_LIMIT_ORDER = 3;
const STOP_MARKET_ORDER = 4;


//buy sell order status
const RUNNING_ORDER = 0;
const EXECUTE_ORDER = 1;
const OPEN_ORDER = 2;
const CANCEL_ORDER = 3;
const CLOSED_ORDER = 4;

//margin mode
const MARGIN_MODE_ISOLATED = 1;
const MARGIN_MODE_CROSS = 2;

//future trade type
const FUTURE_TRADE_PERPETUAL = 1;
const FUTURE_TRADE_DELIVERY = 1;

//future trade position type
const FUTURE_TRADE_IS_NOT_POSITION = 0;
const FUTURE_TRADE_IS_POSITION = 1;
const FUTURE_TRADE_HOLD_POSITION = 2;
const FUTURE_TRADE_STOP_MARKET_LIMIT_POSITION = 3;

//trade side type buy sell
const TRADE_TYPE_BUY = 1;
const TRADE_TYPE_SELL = 2;

//future trade coin type
const FUTURE_TRADE_COIN_TYPE_USDM = 1;
const FUTURE_TRADE_COIN_TYPE_COINM = 2;

//trade type
const FUTURE_TRADE_TYPE_OPEN = 1;
const FUTURE_TRADE_TYPE_CLOSE = 2;
const FUTURE_TRADE_TYPE_TAKE_PROFIT_CLOSE = 3;
const FUTURE_TRADE_TYPE_STOP_LOSS_CLOSE = 4;
const FUTURE_TRADE_TYPE_STOP_MARKET_LIMIT_CLOSE = 5;

//amount type
const AMOUNT_TYPE_BASE = 1;
const AMOUNT_TYPE_TRADE = 2;


// trigger condition
const TRIGGER_CONDITION_LAST=1;
const TRIGGER_CONDITION_MARKET=2;

const FUTURE_TRADE_TRANSACTION_TYPE_TRANSFER = 1;
const FUTURE_TRADE_TRANSACTION_TYPE_COMMISSION = 2;
const FUTURE_TRADE_TRANSACTION_TYPE_FUNDING_FEES = 3;
const FUTURE_TRADE_TRANSACTION_TYPE_REALIZED_PNL = 4;



// Gift Card Wallet Type
const EXCHANGE_WALLET_TYPE = 1;
const P2P_WALLET_TYPE = 2;

// Gift Card Status
const GIFT_CARD_STATUS_ACTIVE = 1;
const GIFT_CARD_STATUS_REDEEMED = 2;
const GIFT_CARD_STATUS_TRANSFARED = 3;
const GIFT_CARD_STATUS_TRADING = 4;
const GIFT_CARD_STATUS_LOCKED = 5;


// Gift Card Buy Request Status
const GIFT_CARD_BULK_BUY = 1;
const GIFT_CARD_SINGLE_BUY = 0;

// Send Gift Card Type
const GIFT_CARD_SEND_BY_EMAIL = 1;
const GIFT_CARD_SEND_BY_PHONE = 2;

const CURRENCY_TYPE_CRYPTO = 1;
const CURRENCY_TYPE_FIAT = 2;

const CONVERT_TYPE_CRYPTO_TO_FIAT = 1;
const CONVERT_TYPE_FIAT_TO_CRYPTO = 2;
const CONVERT_TYPE_FIAT_TO_FIAT = 3;

// Network List
const BINANCE_TESTNET = "BINANCE_TESTNET";
const BTC_TESTNET = "BTC_TESTNET";
const ETH_GOERLI = "ETH_GOERLI";
const POLYGON_MUMBAI = "POLYGON_MUMBAI";
const COIN_PAYMENT_NETWORK = "COIN_PAYMENT";
const BITGO = "BITGO";

// Coin Network Type
const TOKEN_COIN = 1;
const NATIVE_COIN = 2;

const DEFAULT_LOADING_ANNIMATIOM = 1;
const LOGO_LOADING_ANNIMATIOM = 2;

// Network net Type
const NETWORK_MAINNET = 1;
const NETWORK_TESTNET = 2;

// core arrays

//User Roles
use App\Model\CurrencyList;

function userRole($input = null)
{
    $output = [
        USER_ROLE_ADMIN => __('Admin'),
        USER_ROLE_USER => __('User')
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}
//User Activity Array
function userActivity($input = null)
{
    $output = [
         USER_ACTIVITY_LOGIN => __('Log In'),
         USER_ACTIVITY_MOVE_COIN => __("Move coin"),
         USER_ACTIVITY_WITHDRAWAL => __('Withdraw coin'),
         USER_ACTIVITY_CREATE_WALLET => __('Create new wallet'),
         USER_ACTIVITY_CREATE_ADDRESS => __('Create new address'),
         USER_ACTIVITY_MAKE_PRIMARY_WALLET => __('Make wallet primary'),
         USER_ACTIVITY_PROFILE_IMAGE_UPLOAD => __('Upload profile image'),
         USER_ACTIVITY_UPDATE_PASSWORD => __('Update password'),
         USER_ACTIVITY_LOGOUT => __("Logout"),
         USER_ACTIVITY_PROFILE_UPDATE => __('Profile update')
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}
//Discount Type array
function discount_type($input = null)
{
    $output = [
        DISCOUNT_TYPE_FIXED => __('Fixed'),
        DISCOUNT_TYPE_PERCENTAGE => __('Percentage')
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

 function sendFeesType($input = null){
    $output = [
        DISCOUNT_TYPE_FIXED => __('Fixed'),
        DISCOUNT_TYPE_PERCENTAGE => __('Percentage')
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}
function status($input = null)
{
    $output = [
        STATUS_ACTIVE => '<span class="badge badge-success">'.__('Active'). '</span>',
        STATUS_DEACTIVE => '<span class="badge badge-warning">'.__('Deactive').'</span>',
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}
function deposit_status($input = null)
{
    $output = [
        STATUS_ACCEPTED => __('Accepted'),
        STATUS_PENDING => __('Pending'),
        STATUS_REJECTED => __('Rejected'),
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}
function byCoinType($input = null)
{
    $output = [
        CARD => __('CARD'),
        BTC => __('Coin Payment'),
        BANK_DEPOSIT => __('BANK DEPOSIT'),
        STRIPE => __('Credit Card'),

    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

function addressType($input = null){
    $output = [

        ADDRESS_TYPE_INTERNAL => __('Internal'),
        ADDRESS_TYPE_EXTERNAL => __('External'),
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}


function statusAction($input = null)
{
    $output = [
        STATUS_PENDING => '<span class="badge badge-warning">'.__('Pending').'</span>',
        STATUS_SUCCESS => '<span class="badge badge-success">'.__('Active').'</span>',
        STATUS_REJECTED => '<span class="badge badge-secondary">'.__('Rejected').'</span>',
        //STATUS_FINISHED => __('Finished'),
        STATUS_SUSPENDED => '<span class="badge badge-dark">'.__('Suspended').'</span>',
       // STATUS_REJECT => __('Rejected'),
        STATUS_DELETED => '<span class="badge badge-danger">'.__('Deleted').'</span>',
        STATUS_USER_DEACTIVATE => '<span class="badge badge-danger">'.__('De-activate').'</span>',
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

function userStatusActionExport($input)
{
    $output = [
        STATUS_PENDING => __('Pending'),
        STATUS_SUCCESS => __('Active'),
        STATUS_REJECTED => __('Rejected'),
        STATUS_SUSPENDED => __('Suspended'),
        STATUS_DELETED => __('Deleted'),
    ];
    return $output[$input];
}

function onlineStatus($input = null)
{
    $output = [
        STATUS_OFF_ONLINE => '<span class="badge badge-warning">'.__('Off-line').'</span>',
        STATUS_ONLINE => '<span class="badge badge-success">'.__('Online').'</span>',
    ];

    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

function actions($input = null)
{
    $output = [

    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}
function days($input=null){
    $output = [
        DAY_OF_WEEK_MONDAY => __('Monday'),
        DAY_OF_WEEK_TUESDAY => __('Tuesday'),
        DAY_OF_WEEK_WEDNESDAY => __('Wednesday'),
        DAY_OF_WEEK_THURSDAY => __('Thursday'),
        DAY_OF_WEEK_FRIDAY => __('Friday'),
        DAY_OF_WEEK_SATURDAY => __('Saturday'),
        DAY_OF_WEEK_SUNDAY => __('Sunday')
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}
function months($input=null){
    $output = [
        1 => __('January'),
        2 => __('February'),
        3 => __('Merch'),
        4 => __('April'),
        5 => __('May'),
        6 => __('June'),
        7 => __('July'),
        8 => __('August'),
        9 => __('September'),
        10 => __('October'),
        11 => __('November'),
        12 => __('December'),
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}
function customPages($input=null){
    $output = [
        'faqs' => __('FAQS'),
        't_and_c' => __('T&C')
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}


function paymentTypes($input = null)
{
    if (env('APP_ENV') == 'production' )
        $output = [
            PAYMENT_TYPE_LTC => 'LTC',
            PAYMENT_TYPE_BTC => 'BTC',
            PAYMENT_TYPE_USD => 'USDT',
            PAYMENT_TYPE_ETH => 'ETH',
            PAYMENT_TYPE_DOGE => 'DOGE',
            PAYMENT_TYPE_BCH => 'BCH',
            PAYMENT_TYPE_DASH => 'DASH',
        ];
    else
        $output = [
            PAYMENT_TYPE_LTC => 'LTCT',
            PAYMENT_TYPE_BTC => 'BTC',
            PAYMENT_TYPE_USD => 'USDT',
            PAYMENT_TYPE_ETH => 'ETH',
            PAYMENT_TYPE_DOGE => 'DOGE',
            PAYMENT_TYPE_BCH => 'BCH',
            PAYMENT_TYPE_DASH => 'DASH',
        ];

    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

// payment method list
function paymentMethods($input = null)
{
    $output = [
        BTC => __('Coin Payment'),
        BANK_DEPOSIT => __('Bank Deposit'),
        STRIPE => __('Credit card')
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

// check coin type
function check_default_coin_type($coin_type)
{
    $type = $coin_type;
    if($coin_type == DEFAULT_COIN_TYPE) {
        $type = DEFAULT_COIN_TYPE;
    }
    return $type;
}

// coin api settings
function api_settings($input = null)
{
    $output = [
        COIN_PAYMENT => __('Coin Payment Api'),
        BITCOIN_API => __('Bitcoin Api'),
        BITGO_API => __('Bitgo Api'),
        ERC20_TOKEN => __('ERC20 Token Api'),
        BEP20_TOKEN => __('BEP20 Token Api'),
        // TRC20_TOKEN => __('TRC20 Token Api'),
        EVM_BASE_COIN => __('EVM Base Coin'),
        TRC20_TOKEN => __('Tron Base Coin'),
        SOLONA_BASE_COIN => __('Solona Base Coin'),
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return isset($output[$input]) ? $output[$input] : __("Not found");
    }
}

//User Roles
function kycStatus($input = null)
{
    $output = [
        KYC_PENDING => __('Pending'),
        KYC_APPROVED => __('Approved'),
        KYC_REJECTED => __('Rejected'),
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

//page type
function custom_page_type($input = null)
{
    $output = [
        PAGE_TYPE_PRODUCT => __('Footer Heading 1'),
        PAGE_TYPE_SERVICE => __('Footer Heading 2'),
        PAGE_TYPE_SUPPORT => __('Footer Heading 3'),
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

function contract_decimals($input = null)
{
    $output = [
        6 => 'picoether',
        8 => 'customeight',
        9 => 'nanoether',
        12 => 'microether',
        15 => 'milliether',
        18 => 'ether',
        21 => 'kether',
        24 => 'mether',
        27 => 'gether',
        30 => 'tether',
    ];
    if (is_null($input)) {
        return $output;
    } else {
        $result = 'ether';
        if (isset($output[$input])) {
            $result = $output[$input];
        }
        return $result;
    }
}
function contract_decimals_reverse($input = null)
{
    $output = [
        'picoether' => 6,
        'customeight' => 6,
        'nanoether' => 9,
        'microether' => 12,
        'milliether' => 15,
        'ether' => 18,
        'kether' => 21,
        'mether' => 24,
        'gether' => 27,
        'tether' => 30,
    ];
    if (is_null($input)) {
        return $output;
    } else {
        $result = 'ether';
        if (isset($output[$input])) {
            $result = $output[$input];
        }
        return $result;
    }
}
function contract_decimals_value($input = null)
{
    $output = [
        6 => 1000000,
        8 => 100000000,
        9 => 1000000000,
        12 => 1000000000000,
        15 => 1000000000000000,
        18 => 1000000000000000000,
        21 => 1000000000000000000000,
        24 => 1000000000000000000000000,
        27 => 1000000000000000000000000000,
        30 => 1000000000000000000000000000000,
    ];
    if (is_null($input)) {
        return $output;
    } else {
        $result = 18;
        if (isset($output[$input])) {
            $result = $output[$input];
        }
        return $result;
    }
}

function countrylistOld($input=null) {
    $output = [
        "AF" => "Afghanistan",
        "AL" => "Albania",
        "DZ" => "Algeria",
        "AS" => "American Samoa",
        "AD" => "Andorra",
        "AO" => "Angola",
        "AI" => "Anguilla",
        "AQ" => "Antarctica",
        "AG" => "Antigua and Barbuda",
        "AR" => "Argentina",
        "AM" => "Armenia",
        "AW" => "Aruba",
        "AU" => "Australia",
        "AT" => "Austria",
        "AZ" => "Azerbaijan",
        "BS" => "Bahamas",
        "BH" => "Bahrain",
        "BD" => "Bangladesh",
        "BB" => "Barbados",
        "BY" => "Belarus",
        "BE" => "Belgium",
        "BZ" => "Belize",
        "BJ" => "Benin",
        "BM" => "Bermuda",
        "BT" => "Bhutan",
        "BO" => "Bolivia",
        "BA" => "Bosnia and Herzegovina",
        "BW" => "Botswana",
        "BV" => "Bouvet Island",
        "BR" => "Brazil",
        "IO" => "British Indian Ocean Territory",
        "BN" => "Brunei Darussalam",
        "BG" => "Bulgaria",
        "BF" => "Burkina Faso",
        "BI" => "Burundi",
        "KH" => "Cambodia",
        "CM" => "Cameroon",
        "CA" => "Canada",
        "CV" => "Cape Verde",
        "KY" => "Cayman Islands",
        "CF" => "Central African Republic",
        "TD" => "Chad",
        "CL" => "Chile",
        "CN" => "China",
        "CX" => "Christmas Island",
        "CC" => "Cocos (Keeling) Islands",
        "CO" => "Colombia",
        "KM" => "Comoros",
        "CG" => "Congo",
        "CD" => "Congo, the Democratic Republic of the",
        "CK" => "Cook Islands",
        "CR" => "Costa Rica",
        "CI" => "Cote D'Ivoire",
        "HR" => "Croatia",
        "CU" => "Cuba",
        "CY" => "Cyprus",
        "CZ" => "Czech Republic",
        "DK" => "Denmark",
        "DJ" => "Djibouti",
        "DM" => "Dominica",
        "DO" => "Dominican Republic",
        "EC" => "Ecuador",
        "EG" => "Egypt",
        "SV" => "El Salvador",
        "GQ" => "Equatorial Guinea",
        "ER" => "Eritrea",
        "EE" => "Estonia",
        "ET" => "Ethiopia",
        "FK" => "Falkland Islands (Malvinas)",
        "FO" => "Faroe Islands",
        "FJ" => "Fiji",
        "FI" => "Finland",
        "FR" => "France",
        "GF" => "French Guiana",
        "PF" => "French Polynesia",
        "TF" => "French Southern Territories",
        "GA" => "Gabon",
        "GM" => "Gambia",
        "GE" => "Georgia",
        "DE" => "Germany",
        "GH" => "Ghana",
        "GI" => "Gibraltar",
        "GR" => "Greece",
        "GL" => "Greenland",
        "GD" => "Grenada",
        "GP" => "Guadeloupe",
        "GU" => "Guam",
        "GT" => "Guatemala",
        "GN" => "Guinea",
        "GW" => "Guinea-Bissau",
        "GY" => "Guyana",
        "HT" => "Haiti",
        "HM" => "Heard Island and Mcdonald Islands",
        "VA" => "Holy See (Vatican City State)",
        "HN" => "Honduras",
        "HK" => "Hong Kong",
        "HU" => "Hungary",
        "IS" => "Iceland",
        "IN" => "India",
        "ID" => "Indonesia",
        "IR" => "Iran, Islamic Republic of",
        "IQ" => "Iraq",
        "IE" => "Ireland",
        "IL" => "Israel",
        "IT" => "Italy",
        "JM" => "Jamaica",
        "JP" => "Japan",
        "JO" => "Jordan",
        "KZ" => "Kazakhstan",
        "KE" => "Kenya",
        "KI" => "Kiribati",
        "KP" => "Korea, Democratic People's Republic of",
        "KR" => "Korea, Republic of",
        "KW" => "Kuwait",
        "KG" => "Kyrgyzstan",
        "LA" => "Lao People's Democratic Republic",
        "LV" => "Latvia",
        "LB" => "Lebanon",
        "LS" => "Lesotho",
        "LR" => "Liberia",
        "LY" => "Libyan Arab Jamahiriya",
        "LI" => "Liechtenstein",
        "LT" => "Lithuania",
        "LU" => "Luxembourg",
        "MO" => "Macao",
        "MK" => "Macedonia, the Former Yugoslav Republic of",
        "MG" => "Madagascar",
        "MW" => "Malawi",
        "MY" => "Malaysia",
        "MV" => "Maldives",
        "ML" => "Mali",
        "MT" => "Malta",
        "MH" => "Marshall Islands",
        "MQ" => "Martinique",
        "MR" => "Mauritania",
        "MU" => "Mauritius",
        "YT" => "Mayotte",
        "MX" => "Mexico",
        "FM" => "Micronesia, Federated States of",
        "MD" => "Moldova, Republic of",
        "MC" => "Monaco",
        "MN" => "Mongolia",
        "MS" => "Montserrat",
        "MA" => "Morocco",
        "MZ" => "Mozambique",
        "MM" => "Myanmar",
        "NA" => "Namibia",
        "NR" => "Nauru",
        "NP" => "Nepal",
        "NL" => "Netherlands",
        "AN" => "Netherlands Antilles",
        "NC" => "New Caledonia",
        "NZ" => "New Zealand",
        "NI" => "Nicaragua",
        "NE" => "Niger",
        "NG" => "Nigeria",
        "NU" => "Niue",
        "NF" => "Norfolk Island",
        "MP" => "Northern Mariana Islands",
        "NO" => "Norway",
        "OM" => "Oman",
        "PK" => "Pakistan",
        "PW" => "Palau",
        "PS" => "Palestinian Territory, Occupied",
        "PA" => "Panama",
        "PG" => "Papua New Guinea",
        "PY" => "Paraguay",
        "PE" => "Peru",
        "PH" => "Philippines",
        "PN" => "Pitcairn",
        "PL" => "Poland",
        "PT" => "Portugal",
        "PR" => "Puerto Rico",
        "QA" => "Qatar",
        "RE" => "Reunion",
        "RO" => "Romania",
        "RU" => "Russian Federation",
        "RW" => "Rwanda",
        "SH" => "Saint Helena",
        "KN" => "Saint Kitts and Nevis",
        "LC" => "Saint Lucia",
        "PM" => "Saint Pierre and Miquelon",
        "VC" => "Saint Vincent and the Grenadines",
        "WS" => "Samoa",
        "SM" => "San Marino",
        "ST" => "Sao Tome and Principe",
        "SA" => "Saudi Arabia",
        "SN" => "Senegal",
        "CS" => "Serbia and Montenegro",
        "SC" => "Seychelles",
        "SL" => "Sierra Leone",
        "SG" => "Singapore",
        "SK" => "Slovakia",
        "SI" => "Slovenia",
        "SB" => "Solomon Islands",
        "SO" => "Somalia",
        "ZA" => "South Africa",
        "GS" => "South Georgia and the South Sandwich Islands",
        "ES" => "Spain",
        "LK" => "Sri Lanka",
        "SD" => "Sudan",
        "SR" => "Suriname",
        "SJ" => "Svalbard and Jan Mayen",
        "SZ" => "Swaziland",
        "SE" => "Sweden",
        "CH" => "Switzerland",
        "SY" => "Syrian Arab Republic",
        "TW" => "Taiwan, Province of China",
        "TJ" => "Tajikistan",
        "TZ" => "Tanzania, United Republic of",
        "TH" => "Thailand",
        "TL" => "Timor-Leste",
        "TG" => "Togo",
        "TK" => "Tokelau",
        "TO" => "Tonga",
        "TT" => "Trinidad and Tobago",
        "TN" => "Tunisia",
        "TR" => "Turkey",
        "TM" => "Turkmenistan",
        "TC" => "Turks and Caicos Islands",
        "TV" => "Tuvalu",
        "UG" => "Uganda",
        "UA" => "Ukraine",
        "AE" => "United Arab Emirates",
        "GB" => "United Kingdom",
        "US" => "United States",
        "UM" => "United States Minor Outlying Islands",
        "UY" => "Uruguay",
        "UZ" => "Uzbekistan",
        "VU" => "Vanuatu",
        "VE" => "Venezuela",
        "VN" => "Viet Nam",
        "VG" => "Virgin Islands, British",
        "VI" => "Virgin Islands, U.s.",
        "WF" => "Wallis and Futuna",
        "EH" => "Western Sahara",
        "YE" => "Yemen",
        "ZM" => "Zambia",
        "ZW" => "Zimbabwe"

    ];

    if (is_null($input)) {
        return $output;
    } else {

        return $output[$input];
    }
}

function fiat_currency_array($input = null){

// count 164
    $currency_list = array(
        array("name" => "Afghan Afghani", "code" => "AFA", "symbol" => "؋"),
        array("name" => "Albanian Lek", "code" => "ALL", "symbol" => "Lek"),
        array("name" => "Algerian Dinar", "code" => "DZD", "symbol" => "دج"),
        array("name" => "Angolan Kwanza", "code" => "AOA", "symbol" => "Kz"),
        array("name" => "Argentine Peso", "code" => "ARS", "symbol" => "$"),
        array("name" => "Armenian Dram", "code" => "AMD", "symbol" => "֏"),
        array("name" => "Aruban Florin", "code" => "AWG", "symbol" => "ƒ"),
        array("name" => "Australian Dollar", "code" => "AUD", "symbol" => "$"),
        array("name" => "Azerbaijani Manat", "code" => "AZN", "symbol" => "m"),
        array("name" => "Bahamian Dollar", "code" => "BSD", "symbol" => "B$"),
        array("name" => "Bahraini Dinar", "code" => "BHD", "symbol" => ".د.ب"),
        array("name" => "Bangladeshi Taka", "code" => "BDT", "symbol" => "৳"),
        array("name" => "Barbadian Dollar", "code" => "BBD", "symbol" => "Bds$"),
        array("name" => "Belarusian Ruble", "code" => "BYR", "symbol" => "Br"),
        array("name" => "Belgian Franc", "code" => "BEF", "symbol" => "fr"),
        array("name" => "Belize Dollar", "code" => "BZD", "symbol" => "$"),
        array("name" => "Bermudan Dollar", "code" => "BMD", "symbol" => "$"),
        array("name" => "Bhutanese Ngultrum", "code" => "BTN", "symbol" => "Nu."),
        array("name" => "Bolivian Boliviano", "code" => "BOB", "symbol" => "Bs."),
        array("name" => "Bosnia", "code" => "BAM", "symbol" => "KM"),
        array("name" => "Botswanan Pula", "code" => "BWP", "symbol" => "P"),
        array("name" => "Brazilian Real", "code" => "BRL", "symbol" => "R$"),
        array("name" => "British Pound Sterling", "code" => "GBP", "symbol" => "£"),
        array("name" => "Brunei Dollar", "code" => "BND", "symbol" => "B$"),
        array("name" => "Bulgarian Lev", "code" => "BGN", "symbol" => "Лв."),
        array("name" => "Burundian Franc", "code" => "BIF", "symbol" => "FBu"),
        array("name" => "Cambodian Riel", "code" => "KHR", "symbol" => "KHR"),
        array("name" => "Canadian Dollar", "code" => "CAD", "symbol" => "$"),
        array("name" => "Cape Verdean Escudo", "code" => "CVE", "symbol" => "$"),
        array("name" => "Cayman Islands Dollar", "code" => "KYD", "symbol" => "$"),
        array("name" => "CFA Franc BCEAO", "code" => "XOF", "symbol" => "CFA"),
        array("name" => "CFA Franc BEAC", "code" => "XAF", "symbol" => "FCFA"),
        array("name" => "CFP Franc", "code" => "XPF", "symbol" => "₣"),
        array("name" => "Chilean Peso", "code" => "CLP", "symbol" => "$"),
        array("name" => "Chinese Yuan", "code" => "CNY", "symbol" => "¥"),
        array("name" => "Colombian Peso", "code" => "COP", "symbol" => "$"),
        array("name" => "Comorian Franc", "code" => "KMF", "symbol" => "CF"),
        array("name" => "Congolese Franc", "code" => "CDF", "symbol" => "FC"),
        array("name" => "Costa Rican ColÃ³n", "code" => "CRC", "symbol" => "₡"),
        array("name" => "Croatian Kuna", "code" => "HRK", "symbol" => "kn"),
        array("name" => "Cuban Convertible Peso", "code" => "CUC", "symbol" => "$, CUC"),
        array("name" => "Czech Republic Koruna", "code" => "CZK", "symbol" => "Kč"),
        array("name" => "Danish Krone", "code" => "DKK", "symbol" => "Kr."),
        array("name" => "Djiboutian Franc", "code" => "DJF", "symbol" => "Fdj"),
        array("name" => "Dominican Peso", "code" => "DOP", "symbol" => "$"),
        array("name" => "East Caribbean Dollar", "code" => "XCD", "symbol" => "$"),
        array("name" => "Egyptian Pound", "code" => "EGP", "symbol" => "ج.م"),
        array("name" => "Eritrean Nakfa", "code" => "ERN", "symbol" => "Nfk"),
        array("name" => "Estonian Kroon", "code" => "EEK", "symbol" => "kr"),
        array("name" => "Ethiopian Birr", "code" => "ETB", "symbol" => "Nkf"),
        array("name" => "Euro", "code" => "EUR", "symbol" => "€"),
        array("name" => "Falkland Islands Pound", "code" => "FKP", "symbol" => "£"),
        array("name" => "Fijian Dollar", "code" => "FJD", "symbol" => "FJ$"),
        array("name" => "Gambian Dalasi", "code" => "GMD", "symbol" => "D"),
        array("name" => "Georgian Lari", "code" => "GEL", "symbol" => "ლ"),
        array("name" => "German Mark", "code" => "DEM", "symbol" => "DM"),
        array("name" => "Ghanaian Cedi", "code" => "GHS", "symbol" => "GH₵"),
        array("name" => "Gibraltar Pound", "code" => "GIP", "symbol" => "£"),
        array("name" => "Greek Drachma", "code" => "GRD", "symbol" => "₯, Δρχ, Δρ"),
        array("name" => "Guatemalan Quetzal", "code" => "GTQ", "symbol" => "Q"),
        array("name" => "Guinean Franc", "code" => "GNF", "symbol" => "FG"),
        array("name" => "Guyanaese Dollar", "code" => "GYD", "symbol" => "$"),
        array("name" => "Haitian Gourde", "code" => "HTG", "symbol" => "G"),
        array("name" => "Honduran Lempira", "code" => "HNL", "symbol" => "L"),
        array("name" => "Hong Kong Dollar", "code" => "HKD", "symbol" => "$"),
        array("name" => "Hungarian Forint", "code" => "HUF", "symbol" => "Ft"),
        array("name" => "Icelandic KrÃ³na", "code" => "ISK", "symbol" => "kr"),
        array("name" => "Indian Rupee", "code" => "INR", "symbol" => "₹"),
        array("name" => "Indonesian Rupiah", "code" => "IDR", "symbol" => "Rp"),
        array("name" => "Iranian Rial", "code" => "IRR", "symbol" => "﷼"),
        array("name" => "Iraqi Dinar", "code" => "IQD", "symbol" => "د.ع"),
        array("name" => "Israeli New Sheqel", "code" => "ILS", "symbol" => "₪"),
        array("name" => "Italian Lira", "code" => "ITL", "symbol" => "L,£"),
        array("name" => "Jamaican Dollar", "code" => "JMD", "symbol" => "J$"),
        array("name" => "Japanese Yen", "code" => "JPY", "symbol" => "¥"),
        array("name" => "Jordanian Dinar", "code" => "JOD", "symbol" => "ا.د"),
        array("name" => "Kazakhstani Tenge", "code" => "KZT", "symbol" => "лв"),
        array("name" => "Kenyan Shilling", "code" => "KES", "symbol" => "KSh"),
        array("name" => "Kuwaiti Dinar", "code" => "KWD", "symbol" => "ك.د"),
        array("name" => "Kyrgystani Som", "code" => "KGS", "symbol" => "лв"),
        array("name" => "Laotian Kip", "code" => "LAK", "symbol" => "₭"),
        array("name" => "Latvian Lats", "code" => "LVL", "symbol" => "Ls"),
        array("name" => "Lebanese Pound", "code" => "LBP", "symbol" => "£"),
        array("name" => "Lesotho Loti", "code" => "LSL", "symbol" => "L"),
        array("name" => "Liberian Dollar", "code" => "LRD", "symbol" => "$"),
        array("name" => "Libyan Dinar", "code" => "LYD", "symbol" => "د.ل"),
        array("name" => "Lithuanian Litas", "code" => "LTL", "symbol" => "Lt"),
        array("name" => "Macanese Pataca", "code" => "MOP", "symbol" => "$"),
        array("name" => "Macedonian Denar", "code" => "MKD", "symbol" => "ден"),
        array("name" => "Malagasy Ariary", "code" => "MGA", "symbol" => "Ar"),
        array("name" => "Malawian Kwacha", "code" => "MWK", "symbol" => "MK"),
        array("name" => "Malaysian Ringgit", "code" => "MYR", "symbol" => "RM"),
        array("name" => "Maldivian Rufiyaa", "code" => "MVR", "symbol" => "Rf"),
        array("name" => "Mauritanian Ouguiya", "code" => "MRO", "symbol" => "MRU"),
        array("name" => "Mauritian Rupee", "code" => "MUR", "symbol" => "₨"),
        array("name" => "Mexican Peso", "code" => "MXN", "symbol" => "$"),
        array("name" => "Moldovan Leu", "code" => "MDL", "symbol" => "L"),
        array("name" => "Mongolian Tugrik", "code" => "MNT", "symbol" => "₮"),
        array("name" => "Moroccan Dirham", "code" => "MAD", "symbol" => "MAD"),
        array("name" => "Mozambican Metical", "code" => "MZM", "symbol" => "MT"),
        array("name" => "Myanmar Kyat", "code" => "MMK", "symbol" => "K"),
        array("name" => "Namibian Dollar", "code" => "NAD", "symbol" => "$"),
        array("name" => "Nepalese Rupee", "code" => "NPR", "symbol" => "₨"),
        array("name" => "Netherlands Antillean Guilder", "code" => "ANG", "symbol" => "ƒ"),
        array("name" => "New Taiwan Dollar", "code" => "TWD", "symbol" => "$"),
        array("name" => "New Zealand Dollar", "code" => "NZD", "symbol" => "$"),
        array("name" => "Nicaraguan CÃ³rdoba", "code" => "NIO", "symbol" => "C$"),
        array("name" => "Nigerian Naira", "code" => "NGN", "symbol" => "₦"),
        array("name" => "North Korean Won", "code" => "KPW", "symbol" => "₩"),
        array("name" => "Norwegian Krone", "code" => "NOK", "symbol" => "kr"),
        array("name" => "Omani Rial", "code" => "OMR", "symbol" => ".ع.ر"),
        array("name" => "Pakistani Rupee", "code" => "PKR", "symbol" => "₨"),
        array("name" => "Panamanian Balboa", "code" => "PAB", "symbol" => "B/."),
        array("name" => "Papua New Guinean Kina", "code" => "PGK", "symbol" => "K"),
        array("name" => "Paraguayan Guarani", "code" => "PYG", "symbol" => "₲"),
        array("name" => "Peruvian Nuevo Sol", "code" => "PEN", "symbol" => "S/."),
        array("name" => "Philippine Peso", "code" => "PHP", "symbol" => "₱"),
        array("name" => "Polish Zloty", "code" => "PLN", "symbol" => "zł"),
        array("name" => "Qatari Rial", "code" => "QAR", "symbol" => "ق.ر"),
        array("name" => "Romanian Leu", "code" => "RON", "symbol" => "lei"),
        array("name" => "Russian Ruble", "code" => "RUB", "symbol" => "₽"),
        array("name" => "Rwandan Franc", "code" => "RWF", "symbol" => "FRw"),
        array("name" => "Salvadoran ColÃ³n", "code" => "SVC", "symbol" => "₡"),
        array("name" => "Samoan Tala", "code" => "WST", "symbol" => "SAT"),
        array("name" => "Saudi Riyal", "code" => "SAR", "symbol" => "﷼"),
        array("name" => "Serbian Dinar", "code" => "RSD", "symbol" => "din"),
        array("name" => "Seychellois Rupee", "code" => "SCR", "symbol" => "SRe"),
        array("name" => "Sierra Leonean Leone", "code" => "SLL", "symbol" => "Le"),
        array("name" => "Singapore Dollar", "code" => "SGD", "symbol" => "$"),
        array("name" => "Slovak Koruna", "code" => "SKK", "symbol" => "Sk"),
        array("name" => "Solomon Islands Dollar", "code" => "SBD", "symbol" => "Si$"),
        array("name" => "Somali Shilling", "code" => "SOS", "symbol" => "Sh.so."),
        array("name" => "South African Rand", "code" => "ZAR", "symbol" => "R"),
        array("name" => "South Korean Won", "code" => "KRW", "symbol" => "₩"),
        array("name" => "Special Drawing Rights", "code" => "XDR", "symbol" => "SDR"),
        array("name" => "Sri Lankan Rupee", "code" => "LKR", "symbol" => "Rs"),
        array("name" => "St. Helena Pound", "code" => "SHP", "symbol" => "£"),
        array("name" => "Sudanese Pound", "code" => "SDG", "symbol" => ".س.ج"),
        array("name" => "Surinamese Dollar", "code" => "SRD", "symbol" => "$"),
        array("name" => "Swazi Lilangeni", "code" => "SZL", "symbol" => "E"),
        array("name" => "Swedish Krona", "code" => "SEK", "symbol" => "kr"),
        array("name" => "Swiss Franc", "code" => "CHF", "symbol" => "CHf"),
        array("name" => "Syrian Pound", "code" => "SYP", "symbol" => "LS"),
        array("name" => "São Tomé and Príncipe Dobra", "code" => "STD", "symbol" => "Db"),
        array("name" => "Tajikistani Somoni", "code" => "TJS", "symbol" => "SM"),
        array("name" => "Tanzanian Shilling", "code" => "TZS", "symbol" => "TSh"),
        array("name" => "Thai Baht", "code" => "THB", "symbol" => "฿"),
        array("name" => "Tongan pa'anga", "code" => "TOP", "symbol" => "$"),
        array("name" => "Trinidad & Tobago Dollar", "code" => "TTD", "symbol" => "$"),
        array("name" => "Tunisian Dinar", "code" => "TND", "symbol" => "ت.د"),
        array("name" => "Turkish Lira", "code" => "TRY", "symbol" => "₺"),
        array("name" => "Turkmenistani Manat", "code" => "TMT", "symbol" => "T"),
        array("name" => "Ugandan Shilling", "code" => "UGX", "symbol" => "USh"),
        array("name" => "Ukrainian Hryvnia", "code" => "UAH", "symbol" => "₴"),
        array("name" => "United Arab Emirates Dirham", "code" => "AED", "symbol" => "إ.د"),
        array("name" => "Uruguayan Peso", "code" => "UYU", "symbol" => "$"),
        array("name" => "US Dollar", "code" => "USD", "symbol" => "$"),
        array("name" => "Uzbekistan Som", "code" => "UZS", "symbol" => "лв"),
        array("name" => "Vanuatu Vatu", "code" => "VUV", "symbol" => "VT"),
        array("name" => "Venezuelan BolÃvar", "code" => "VEF", "symbol" => "Bs"),
        array("name" => "Vietnamese Dong", "code" => "VND", "symbol" => "₫"),
        array("name" => "Yemeni Rial", "code" => "YER", "symbol" => "﷼"),
        array("name" => "Zambian Kwacha", "code" => "ZMK", "symbol" => "ZK")
    );
    if($input != null){
        foreach($currency_list as $item){
            if($item['code'] == $input){
                return $item;
            }
        }
    }
    return $currency_list;
}

function fiatCurrency($input=null) {
    if (is_null($input)) {
        $allCountry = CurrencyList::where(['status' => STATUS_ACTIVE])->get();
        if (isset($allCountry[0])) {
            $output = [];
            foreach ($allCountry as $setting) {
                $output[$setting->code] = __($setting->name);
            }
            return $output;
        }
        return [];
    } else {
        $allCountry = CurrencyList::where(['code' => strtoupper($input)])->first();
        if ($allCountry) {
            $output = __($allCountry->name);
            return $output;
        }
        return '';
    }
}

// usdt wallet network
function usdtWalletNetwork($input = null)
{
    $output = [
        USDT_TRC20 => __('Tether USD (Tron/TRC20)'),
        USDT_ERC20 => __('Tether USD (ERC20)'),
        USDT_BEP20 => __('Tether USD (BEP20)'),
        USDT_SOLANA => __('Tether USD (Solana)'),
        USDT_OMNILAYER => __('Tether USD (Omni Layer)'),
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

// currency deposit payment method
function currencyDepositPaymentMethod($input = null)
{
    $output = [
        BANK_DEPOSIT => __('Bank Deposit'),
        STRIPE => __('Credit Card'),
        WALLET_DEPOSIT => __('Wallet Deposit'),
        PAYPAL => __('Paypal'),
        CRYPTO => __('Crypto'),
        // SKRILL => __('Skrill'),
        PAYSTACK => __('Paystack'),
        // RAZORPAY => __('Razorpay'),
    ];

    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input]??__('Not Found!');
    }
}

function currencyWithdrawalPaymentMethod($input = null)
{
    $output = [
        BANK_DEPOSIT => __('Bank Deposit'),
        STRIPE => __('Credit Card'),
        PAYPAL => __('Paypal'),
        // SKRILL => __('Skrill'),
        PAYSTACK => __('Paystack'),
        // RAZORPAY => __('Razorpay'),
    ];

    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input]??__('Not Found!');
    }
}

//FAQ TYPE
function faqType($input = null)
{
    $output = [
        FAQ_TYPE_MAIN => __('Main'),
        FAQ_TYPE_DEPOSIT => __('Deposit'),
        FAQ_TYPE_FIAT_DEPOSIT => __('Fiat Deposit'),
        FAQ_TYPE_WITHDRAWN => __('Withdrawn'),
        FAQ_TYPE_BUY => __('Buy'),
        FAQ_TYPE_SELL => __('Sell'),
        FAQ_TYPE_COIN => __('Coin'),
        FAQ_TYPE_WALLET => __('Wallet'),
        FAQ_TYPE_TRADE => __('Trade'),
        FAQ_TYPE_P2P => __('P2P'),
        FAQ_TYPE_STACKING => __('Stacking'),
        FAQ_TYPE_GIFT_CARD => __('Gift Card'),

    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

//progress staatus TYPE
function progressStatusType($input = null)
{
    $output = [
        PROGRESS_STATUS_TYPE_DEPOSIT => __('Deposit'),
        PROGRESS_STATUS_TYPE_WITHDRAWN => __('Withdrawn'),

    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

//FAQ TYPE
function kycList($input = null)
{
    $output = [
        KYC_PHONE_VERIFICATION => __('Phone Number'),
        KYC_EMAIL_VERIFICATION => __('Email'),
        KYC_NID_VERIFICATION => __('National ID'),
        KYC_PASSPORT_VERIFICATION => __('Passport'),
        KYC_DRIVING_VERIFICATION => __('Driver License'),
        KYC_VOTERS_CARD_VERIFICATION => __('Voter Card'),

    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

function yesNo($val,$enable = false){
    if($enable){
        if($val) return 'Enable';
        return 'Disable';
    }
    if($val) return 'Yes';
    return 'No';
}

//exchange layout
function exchangeLayout($input = null)
{
    $output = [
        EXCHANGE_LAYOUT_ONE => __('Layout One'),
        EXCHANGE_LAYOUT_TWO => __('Layout Two'),
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

//page link type
function custom_page_link_type($input = null)
{
    $output = [
        CUSTOM_PAGE_LINK_PAGE => __('Custom Page'),
        CUSTOM_PAGE_LINK_URL => __('Custom Url'),
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

/*********************************************
 *        End Ststus Functions
 *********************************************/

function getTwoFactorArray($index = null){
    $array = [
        GOOGLE_AUTH => __("Google Auth"),
        EMAIL_AUTH => __("Email"),
        PHONE_AUTH => __("Phone Number")
    ];
    if($index) return $array[$index];
    return $array;
}

function webhook_type($input = null)
{
    $output = [
//        WEBHOOK_TYPE_TRANSFER => __('Transfer'),
        WEBHOOK_TYPE_TRANSACTION => __('Transaction'),
//        WEBHOOK_TYPE_PENDING_APPROVAL => __('Pending Approval'),
//        WEBHOOK_TYPE_ADDRESS_CONFIRM => __('Address Confirmation'),
//        WEBHOOK_TYPE_LOW_FEE => __('Low Fee'),
    ];
    if (is_null($input)) {
        return $output;
    } else {
        return $output[$input];
    }
}

function fiat_widthraw_type($index){
    $arr = [
        Fiat_Withdraw_PERCENT => __('Percentage'),
        Fiat_Withdraw_FIXED => __('Fixed')
    ];
    if($index){
        return isset($arr[$index]) ? $arr[$index] : '';
    }
    return $arr;
}

function captchTypeList($index = null){
    $arr = [
        CAPTCHA_TYPE_DISABLE => __('Captcha Disabled'),
        CAPTCHA_TYPE_RECAPTCHA => __('Google Re-Captcha'),
        CAPTCHA_TYPE_GEETESTCAPTCHA => __('GeeTest Captcha')
    ];
    if($index){
        return isset($arr[$index]) ? $arr[$index] : '';
    }
    return $arr;
}

function kycTypeList($index = null){
    $arr = [
        KYC_TYPE_DISABLE => __('KYC Disabled'),
        KYC_TYPE_MANUAL => __('Manual KYC Enabled'),
        KYC_TYPE_PERSONA => __('Third Party (Persona) KYC Enabled')
    ];
    if($index){
        return isset($arr[$index]) ? $arr[$index] : '';
    }
    return $arr;
}
//email template number list
function emailTemplateList($index = null){
    $arr = [
        EMAIL_TEMPLATE_NUMBER_ONE => __('Template One'),
        EMAIL_TEMPLATE_NUMBER_TWO => __('Template Two'),
        EMAIL_TEMPLATE_NUMBER_THREE => __('Template Three'),
        EMAIL_TEMPLATE_NUMBER_FOUR => __('Template Four'),
    ];
    if($index){
        return isset($arr[$index]) ? $arr[$index] : '';
    }
    return $arr;
}

//sms type list
function smsTypeList($index = null){
    $arr = [
        SMS_TYPE_DISABLE => __('Disabled'),
        SMS_TYPE_TWILIO => __('Twilio SMS Service'),
        SMS_TYPE_NEXMO => __('Vonage/Nexmo SMS Service'),
        SMS_TYPE_AFRICA_TALK => __('Africa Talking SMS Service'),
    ];
    if($index){
        return isset($arr[$index]) ? $arr[$index] : '';
    }
    return $arr;
}

//staking terms type list
function getTermsTypeListStaking($index = null)
{
    $arr = [
        STAKING_TERMS_TYPE_STRICT => __('Locked'),
        STAKING_TERMS_TYPE_FLEXIBLE => __('Flexible')
    ];
    if($index){
        return isset($arr[$index]) ? $arr[$index] : '';
    }
    return $arr;
}

//staking investment status
function getInvestmentStatusStaking($index = null)
{
    $arr = [
        STAKING_INVESTMENT_STATUS_RUNNING => __('Running'),
        STAKING_INVESTMENT_STATUS_CANCELED => __('Canceled'),
        STAKING_INVESTMENT_STATUS_UNPAID => __('Un Paid'),
        STAKING_INVESTMENT_STATUS_PAID => __('Paid'),
        STAKING_INVESTMENT_STATUS_SUCCESS => __('Success'),
    ];
    if($index){
        return isset($arr[$index]) ? $arr[$index] : '';
    }
    return $arr;
}

//staking investment status
function autoRenewList($index = null)
{
    $arr = [
        STAKING_IS_NOT_AUTO_RENEW => __('No'),
        STAKING_IS_AUTO_RENEW => __('Yes')
    ];

    if($index){
        return isset($arr[$index]) ? $arr[$index] : '';
    }
    return $arr;
}

//future trade transform type
function futureTradeTransformType($index = null)
{
    $arr = [
        SPOT_TRADE => __('Spot Wallet to Future Wallet'),
        FUTURE_TRADE => __('Future Wallet to Spot Wallet')
    ];

    if($index !== null){
        return isset($arr[$index]) ? $arr[$index] : '';
    }
    return $arr;
}
// gift card wallet type name
function getWalletGiftCard($index = null){
    $arr = [
        EXCHANGE_WALLET_TYPE => __('Spot Wallet'),
        P2P_WALLET_TYPE => __('P2P Wallet')
    ];

    if($index !== null){
        return isset($arr[$index]) ? $arr[$index] : '';
    }
    return $arr;
}

function getStatusGiftCard($index = null){
    $arr = [
        GIFT_CARD_STATUS_REDEEMED => __('Complete'),
        GIFT_CARD_STATUS_ACTIVE => __('Active'),
        GIFT_CARD_STATUS_TRANSFARED => __('Transferred'),
        GIFT_CARD_STATUS_TRADING => __('In Trading'),
        GIFT_CARD_STATUS_LOCKED => __('Locked'),
    ];

    if($index !== null){
        return isset($arr[$index]) ? $arr[$index] : '';
    }
    return $arr;
}

function futureTradeTransactionHistoryType($index = 'all')
{
    $types = [
        FUTURE_TRADE_TRANSACTION_TYPE_TRANSFER => __('Transfer History'),
        FUTURE_TRADE_TRANSACTION_TYPE_COMMISSION => __('Commission History'),
        FUTURE_TRADE_TRANSACTION_TYPE_FUNDING_FEES => __('Funding Fees History'),
        FUTURE_TRADE_TRANSACTION_TYPE_REALIZED_PNL => __('Realized PNL History')
    ];

    if($index == 'all') return $types;

    if(isset($types[$index]))
        return $types[$index];

    return __("Not Found");
}

function futureTradeType($index = 'all')
{
    $types = [
        FUTURE_TRADE_TYPE_OPEN => __("Open Order History"),
        FUTURE_TRADE_TYPE_CLOSE => __("Close Order History"),
        // FUTURE_TRADE_TYPE_TAKE_PROFIT_CLOSE => __(""),
        // FUTURE_TRADE_TYPE_STOP_LOSS_CLOSE => __("")
    ];

    if($index == 'all') return $types;

    if(isset($types[$index]))
        return $types[$index];

    return __("Not Found");
}

function futureTradeSideList($index = 'all')
{
    $types = [
        TRADE_TYPE_BUY => __("Trade Long"),
        TRADE_TYPE_SELL => __("Trade Short")
    ];

    if($index == 'all') return $types;

    if(isset($types[$index]))
        return $types[$index];

    return __("Not Found");
}

function openOrderTrigerCondition ($openOrder){

    if ($openOrder?->side === 1) {
        if ($openOrder?->take_profit_price > 0) {
            return __("Mark price >= ") . $openOrder?->take_profit_price;
        } else {
            return __("Mark price <= ") . $openOrder?->stop_loss_price;
        }
    } else {
        if ($openOrder?->take_profit_price > 0) {
            return __("Mark price <= ") . $openOrder?->take_profit_price;
        } else {
            return __("Mark price >= ") . $openOrder?->stop_loss_price;
        }
    }

}

function getTradeCurrencyType($index = null)
{
    $array = [
        CURRENCY_TYPE_CRYPTO => __("Crypto"),
        CURRENCY_TYPE_FIAT => __("Fiat"),
    ];
    if(isset($array[$index])) return $array[$index];
    return $array;
}

function getEvmNetworks($index = null)
{
    $networks = [
        BINANCE_TESTNET => BINANCE_TESTNET,
        BTC_TESTNET => BTC_TESTNET,
        ETH_GOERLI => ETH_GOERLI,
        POLYGON_MUMBAI => POLYGON_MUMBAI,
        // COIN_PAYMENT_NETWORK => COIN_PAYMENT_NETWORK,
        // BITGO => BITGO
    ];
    if(is_null($index)) return $networks;
    if(isset($networks[$index])) return $networks[$index];
    return __("Not found");
}


function getCoinNetworkType($index = null):string|array
{
    $types = [
        TOKEN_COIN  => __("Token"),
        NATIVE_COIN => __("Native"),
    ];
    if(is_null($index)) return $types;
    if(isset($types[$index])) return $types[$index];
    return __("Not found");
}

function getBaseNetworkType($index = null):string|array
{
    $hiddenTypes = [
        COIN_PAYMENT => __("Coin Payment"),
        BITGO_API =>  __("Bitgo"),
        BITCOIN_API => __('Bitcoin'),
    ];
    $types = [
        EVM_BASE_COIN => __("EVM Base"),
        TRC20_TOKEN => __('Tron Base'),
        SOLONA_BASE_COIN => __('Solona Base'),
    ];
    $hiddenTypesKeys = array_keys($hiddenTypes);
    $TypesKeys = array_keys($types);
    if(is_null($index)) return $types;
    $types = array_combine([...$hiddenTypesKeys, ...$TypesKeys], [...$hiddenTypes, ...$types]);
    if(isset($types[$index])) return $types[$index];
    return __("Not found");
}

function getNetworkSlug($index){
    $types = [
        COIN_PAYMENT => ('coin_payment'),
        BITCOIN_API => ('bitcoin_api'),
        BITGO_API => ('bitgo_api'),
        ERC20_TOKEN => ('ethereum'),
        BEP20_TOKEN => ('bnbmainnet'),
        TRC20_TOKEN => ('tronmainnet'),

    ];

    if(isset($types[$index])) return $types[$index];
    return __("Not found");
}
function getNetBaseType($index) {
    if ($index == ERC20_TOKEN || $index == BEP20_TOKEN) {
        return EVM_BASE_COIN;
    } elseif($index == TRC20_TOKEN) {
        return TRC20_TOKEN;
    } else {
        return $index;
    }
}

function removeDirectory($directoryPath) {
    if (is_dir($directoryPath)) {
        $objects = scandir($directoryPath);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($directoryPath . "/" . $object)) {
                    removeDirectory($directoryPath . "/" . $object);
                } else {
                    unlink($directoryPath . "/" . $object);
                }
            }
        }
        rmdir($directoryPath);
        echo "Directory and its contents removed successfully.";
    } else {
        echo "Directory does not exist.";
    }
}