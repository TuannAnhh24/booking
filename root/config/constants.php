<?php

const LINK_SOFT_DELETE = 'Illuminate\Database\Eloquent\SoftDeletes';

// paginate
const PAGINATE_LIMIT = 3;
const PAGINATE_MAX_RECORD = 10;
const MAX_ITEM_CHUNK = 100;
const FORMAT_DATE = "Y-m-d";
const FORMAT_DATE_TIME = "Y-m-d H:i:s";
const FORMAT_DATE_COMPETITION = "d/m/Y H:i";
const FORMAT_TIME = 'H:i:s';
const FORMAT_SECOND = 's';
const FORMAT_DATE_EMPLOYEE = "d/m/Y";
const MAX_DAY = 31;
const setMargin_Qr = 10;
const GENDER = [
    'FEMALE' => 0,
    'MALE' => 1,
];

const DEFAULT_PASSWORD = '12345678';

const LIST_LASTEST = [
    'limit' => 5,
    'offset' => 0,
];

const ROLES = [
    "user" => 1,
    "user_admin" => 2,
    'system_admin' => 3,
    'super_admin' => 4,
];

const MAX_ITEM_MYPAGE_CONSULTATIONS = 5;
const MAX_ITEM_MYPAGE_INQUIRY = 5;
const MAX_ITEM_MYPAGE = 3;

const MAX_IMAGE_INTERVIEW = 4;

const DELETE_FLG = 1;
const MAX_ITEM_RECIEVER_EMAIL = 2;
const MAX_ITEM_RECIEVER_EMAIL_PROVIDER = 3;

const PERPAGE_OPTIONS = [5, 10, 15, 20, 25, 30, 50, 100];

const SORT_DEFAULT = [
    'DESC' => 0,
    'ASC' => 1,
];

const ACCESS_COUNT_DEFAULT = 0;
const SEARCH_ADDRESS_DEFAULT = 9;

const CONTACTED_FLG = [
    'UNCONTACTED' => 0,
    'CONTACTED' => 1,
];

const ALL_AREA = 0;
// const MAX_DAY = 31;

const CATEGORY_IMAGES_DIRECTORY = 'categoryImages';
const BANNER_IMAGES_DIRECTORY = 'bannerImages';
const REVIEW_IMAGES_DIRECTORY = 'reviewImages';

const IMAGE_PATHS = [
    'variant_images' => 'variantImages',
    'room_images' => 'roomImages',
];

const LOCATION_IMAGES_PATH = 'locationImages';
const DESTINATION_IMAGES_PATH = 'destinationImages';
const USER_IMAGES_PATH = 'userImages';

const PROMOTION_IMAGE_PATH = 'promotions';
const DESKTOP = 'desktop';
const TABLET = 'tablet';
const MOBILE = 'mobile';
const UNKNOWN = 'unknown';
const ACTIVE = 'active';
const COMPLETED = 'completed';
const CANCELED = 'canceled';
const NOT_ACTIVE = 'not_active';

const TOP5 = 5;
