<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $is_super
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereIsSuper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Allowance
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $display_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $positions
 * @property-read int|null $positions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance newQuery()
 * @method static \Illuminate\Database\Query\Builder|Allowance onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Allowance withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Allowance withoutTrashed()
 */
	class Allowance extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Branch
 *
 * @property int $id
 * @property int $device_id
 * @property string $name
 * @property string $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\BranchFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newQuery()
 * @method static \Illuminate\Database\Query\Builder|Branch onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Branch withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Branch withoutTrashed()
 */
	class Branch extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $password
 * @property string $name_ar
 * @property string $name_en
 * @property string|null $code
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $start_date
 * @property string|null $commercial_registration_no
 * @property string|null $tax_registration_no
 * @property string|null $tax_file_no
 * @property string|null $tax_office
 * @property string|null $type
 * @property string|null $country
 * @property string|null $governorate
 * @property string|null $city
 * @property string|null $district
 * @property string|null $post_number
 * @property string|null $building_number
 * @property string|null $street_name
 * @property int $active
 * @property string|null $remember_token
 * @property string|null $image
 * @property string|null $client_id
 * @property string|null $client_secret
 * @property string|null $taxpayerActivityCode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $client_customer_type
 * @property-read mixed $display_name
 * @property-read mixed $full_address
 * @property-read mixed $profile_pic
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Query\Builder|Client onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereBuildingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereClientCustomerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCommercialRegistrationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereGovernorate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePostNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereStreetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTaxFileNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTaxOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTaxRegistrationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTaxpayerActivityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Client withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Client withoutTrashed()
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientBalanceSheet
 *
 * @method static \Database\Factories\ClientBalanceSheetFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientBalanceSheet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientBalanceSheet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientBalanceSheet query()
 */
	class ClientBalanceSheet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Code
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property string $code
 * @property-read mixed $display_name
 * @method static \Illuminate\Database\Eloquent\Builder|Code newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Code newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Code query()
 * @method static \Illuminate\Database\Eloquent\Builder|Code whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Code whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Code whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Code whereNameEn($value)
 */
	class Code extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @property int $id
 * @property int $client_id
 * @property string $email
 * @property string $name_ar
 * @property string $name_en
 * @property string|null $code
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $start_date
 * @property string|null $commercial_registration_no
 * @property string|null $tax_registration_no
 * @property string|null $tax_file_no
 * @property string|null $tax_office
 * @property string|null $type
 * @property string|null $country
 * @property string|null $governorate
 * @property string|null $city
 * @property string|null $district
 * @property string|null $post_number
 * @property string|null $building_number
 * @property string|null $street_name
 * @property string|null $national_id
 * @property string|null $passport_id
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $display_name
 * @property-read mixed $full_address
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBuildingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCommercialRegistrationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereGovernorate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereNationalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePassportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePostNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereStreetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTaxFileNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTaxOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTaxRegistrationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Department
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $display_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $positions
 * @property-read int|null $positions_count
 * @method static \Database\Factories\DepartmentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Query\Builder|Department onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Department withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Department withoutTrashed()
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Device
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Query\Builder|Device onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Device withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Device withoutTrashed()
 */
	class Device extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ExpensesItem
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $display_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $positions
 * @property-read int|null $positions_count
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensesItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensesItem newQuery()
 * @method static \Illuminate\Database\Query\Builder|ExpensesItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensesItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensesItem whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensesItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensesItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensesItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensesItem whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensesItem whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpensesItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ExpensesItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ExpensesItem withoutTrashed()
 */
	class ExpensesItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\HistoricalEvent
 *
 * @property int $id
 * @property string $name
 * @property string $affect_model
 * @property string $affect_id
 * @property string $action
 * @property string $by_model
 * @property string $by_id
 * @property string $log
 * @property array $extra_info
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent whereAffectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent whereAffectModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent whereById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent whereByModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent whereExtraInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoricalEvent whereUpdatedAt($value)
 */
	class HistoricalEvent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InvoiceFooter
 *
 * @property int $id
 * @property int $invoice_header_id
 * @property int $product_id
 * @property string|null $product_code
 * @property int|null $productTypeID
 * @property int|null $taxTypeID
 * @property string|null $productUnit
 * @property float|null $productQuantity
 * @property float|null $productUnitPrice
 * @property float|null $Discount
 * @property float|null $productTotalNet
 * @property float|null $productTotalTaxValue
 * @property float|null $productTaxValue
 * @property float|null $productTotalMoney
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter newQuery()
 * @method static \Illuminate\Database\Query\Builder|InvoiceFooter onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereInvoiceHeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereProductCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereProductQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereProductTaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereProductTotalMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereProductTotalNet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereProductTotalTaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereProductTypeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereProductUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereProductUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereTaxTypeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceFooter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|InvoiceFooter withTrashed()
 * @method static \Illuminate\Database\Query\Builder|InvoiceFooter withoutTrashed()
 */
	class InvoiceFooter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InvoiceHeader
 *
 * @property int $id
 * @property int $client_id
 * @property int|null $invoiceTypeId
 * @property int|null $itemType
 * @property int|null $sectionNumID
 * @property string|null $invoiceNumber
 * @property int $customer_id
 * @property string|null $customerUniqueTaxId
 * @property string|null $customerFileNumber
 * @property string|null $CustomerAddress
 * @property string|null $customerNationalId
 * @property string|null $customerForeignId
 * @property string|null $customerMobile
 * @property string|null $invoiceDate
 * @property float|null $total_net_amount
 * @property float|null $total_tax_value
 * @property float|null $total_discount
 * @property float|null $total_value
 * @property string|null $uuid
 * @property string|null $tax_status
 * @property string|null $tax_notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InvoiceFooter[] $footer
 * @property-read int|null $footer_count
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader newQuery()
 * @method static \Illuminate\Database\Query\Builder|InvoiceHeader onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereCustomerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereCustomerFileNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereCustomerForeignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereCustomerMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereCustomerNationalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereCustomerUniqueTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereInvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereInvoiceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereItemType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereSectionNumID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereTaxNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereTaxStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereTotalDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereTotalNetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereTotalTaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereTotalValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceHeader whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|InvoiceHeader withTrashed()
 * @method static \Illuminate\Database\Query\Builder|InvoiceHeader withoutTrashed()
 */
	class InvoiceHeader extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LateDeductions
 *
 * @property int $id
 * @property float $from
 * @property float $to
 * @property int $deduct
 * @property float|null $deduct_days
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions newQuery()
 * @method static \Illuminate\Database\Query\Builder|LateDeductions onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions query()
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions whereDeduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions whereDeductDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LateDeductions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|LateDeductions withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LateDeductions withoutTrashed()
 */
	class LateDeductions extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MissionsTypes
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $display_name
 * @method static \Illuminate\Database\Eloquent\Builder|MissionsTypes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MissionsTypes newQuery()
 * @method static \Illuminate\Database\Query\Builder|MissionsTypes onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MissionsTypes query()
 * @method static \Illuminate\Database\Eloquent\Builder|MissionsTypes whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissionsTypes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissionsTypes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissionsTypes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissionsTypes whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissionsTypes whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissionsTypes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|MissionsTypes withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MissionsTypes withoutTrashed()
 */
	class MissionsTypes extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OfficialVacations
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $display_name
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacations newQuery()
 * @method static \Illuminate\Database\Query\Builder|OfficialVacations onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacations query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacations whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacations whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacations whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacations whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacations whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|OfficialVacations withTrashed()
 * @method static \Illuminate\Database\Query\Builder|OfficialVacations withoutTrashed()
 */
	class OfficialVacations extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OfficialVacationsDays
 *
 * @property int $id
 * @property int $official_vacations_id
 * @property string $date
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\OfficialVacations $official_vacation
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacationsDays newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacationsDays newQuery()
 * @method static \Illuminate\Database\Query\Builder|OfficialVacationsDays onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacationsDays query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacationsDays whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacationsDays whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacationsDays whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacationsDays whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacationsDays whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacationsDays whereOfficialVacationsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfficialVacationsDays whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|OfficialVacationsDays withTrashed()
 * @method static \Illuminate\Database\Query\Builder|OfficialVacationsDays withoutTrashed()
 */
	class OfficialVacationsDays extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaySalaries
 *
 * @property int $id
 * @property int $staff_id
 * @property string $from_date
 * @property string $to_date
 * @property int $month
 * @property int $year
 * @property float $fixed_salary
 * @property float|null $allowances
 * @property float|null $rewards
 * @property float|null $punishments
 * @property float|null $debts
 * @property string|null $debts_ids
 * @property float|null $loans
 * @property string|null $staff_loans_installment_id
 * @property float $final_salary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries newQuery()
 * @method static \Illuminate\Database\Query\Builder|PaySalaries onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereAllowances($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereDebts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereDebtsIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereFinalSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereFixedSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereFromDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereLoans($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries wherePunishments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereRewards($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereStaffLoansInstallmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereToDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaySalaries whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|PaySalaries withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PaySalaries withoutTrashed()
 */
	class PaySalaries extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Position
 *
 * @property int $id
 * @property int $department_id
 * @property string $name_ar
 * @property string $name_en
 * @property string|null $description_ar
 * @property string|null $description_en
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Department $department
 * @property-read mixed $display_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Staff[] $staff
 * @property-read int|null $staff_count
 * @method static \Illuminate\Database\Eloquent\Builder|Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Position newQuery()
 * @method static \Illuminate\Database\Query\Builder|Position onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereDescriptionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Position withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Position withoutTrashed()
 */
	class Position extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property int|null $client_id
 * @property string $name_ar
 * @property string $name_en
 * @property string $code
 * @property float|null $price
 * @property string $unit
 * @property int $quantity
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $display_name
 * @property-read \App\Models\Warehouse|null $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PunishmentRules
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property float $punishment_per_day
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $display_name
 * @method static \Illuminate\Database\Eloquent\Builder|PunishmentRules newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PunishmentRules newQuery()
 * @method static \Illuminate\Database\Query\Builder|PunishmentRules onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PunishmentRules query()
 * @method static \Illuminate\Database\Eloquent\Builder|PunishmentRules whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PunishmentRules whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PunishmentRules whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PunishmentRules whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PunishmentRules whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PunishmentRules whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PunishmentRules wherePunishmentPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PunishmentRules whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|PunishmentRules withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PunishmentRules withoutTrashed()
 */
	class PunishmentRules extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Shift
 *
 * @property int $id
 * @property string $from
 * @property string $to
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Shift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shift newQuery()
 * @method static \Illuminate\Database\Query\Builder|Shift onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Shift query()
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Shift withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Shift withoutTrashed()
 */
	class Shift extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Staff
 *
 * @property int $id
 * @property int|null $branch_id
 * @property int $position_id
 * @property string $full_name_ar
 * @property string $full_name_en
 * @property string $gender
 * @property string $email
 * @property string $date_of_work
 * @property string|null $graduation_date
 * @property string|null $university_ar
 * @property string|null $university_en
 * @property string|null $educational_ar
 * @property string|null $educational_en
 * @property int|null $insurance_no
 * @property string $date_of_birth
 * @property string $address
 * @property string $phone
 * @property string $mobile
 * @property string $personal_image
 * @property string $national_id
 * @property int $finger_print_id
 * @property string $user_name
 * @property string $password
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Branch|null $branch
 * @property-read mixed $display_name
 * @property-read mixed $personal_image_path
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Position $position
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Staff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff newQuery()
 * @method static \Illuminate\Database\Query\Builder|Staff onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff query()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereDateOfWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereEducationalAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereEducationalEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereFingerPrintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereFullNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereFullNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereGraduationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereInsuranceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereNationalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff wherePersonalImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereUniversityAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereUniversityEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereUserName($value)
 * @method static \Illuminate\Database\Query\Builder|Staff withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Staff withoutTrashed()
 */
	class Staff extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffActivites
 *
 * @property int $id
 * @property int $finger_print_id
 * @property string $device_id
 * @property string $activity_time
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $activity_time_js
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|StaffActivites newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffActivites newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffActivites onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffActivites query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffActivites whereActivityTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffActivites whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffActivites whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffActivites whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffActivites whereFingerPrintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffActivites whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffActivites whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffActivites whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StaffActivites withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffActivites withoutTrashed()
 */
	class StaffActivites extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffAllowances
 *
 * @property int $id
 * @property int $staff_id
 * @property int $allowance_id
 * @property float $amount
 * @property string $date
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Allowance $allowance
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffAllowances onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances whereAllowanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffAllowances whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StaffAllowances withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffAllowances withoutTrashed()
 */
	class StaffAllowances extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffDebts
 *
 * @property int $id
 * @property int $staff_id
 * @property float $amount
 * @property string $date
 * @property int $repayment
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffDebts onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts whereRepayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffDebts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StaffDebts withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffDebts withoutTrashed()
 */
	class StaffDebts extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffLoans
 *
 * @property int $id
 * @property int $staff_id
 * @property float $total_amount
 * @property string $date
 * @property int $number_of_installments
 * @property int $status
 * @property string|null $notes
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffLoans onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans whereNumberOfInstallments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoans whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StaffLoans withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffLoans withoutTrashed()
 */
	class StaffLoans extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffLoansInstallments
 *
 * @property int $id
 * @property int $staff_loan_id
 * @property float $amount
 * @property string $due_date
 * @property string|null $collection_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoansInstallments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoansInstallments newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffLoansInstallments onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoansInstallments query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoansInstallments whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoansInstallments whereCollectionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoansInstallments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoansInstallments whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoansInstallments whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoansInstallments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoansInstallments whereStaffLoanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffLoansInstallments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StaffLoansInstallments withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffLoansInstallments withoutTrashed()
 */
	class StaffLoansInstallments extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffMissions
 *
 * @property int $id
 * @property int $staff_id
 * @property int $mission_type_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\MissionsTypes $mission_type
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|StaffMissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffMissions newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffMissions onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffMissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffMissions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffMissions whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffMissions whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffMissions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffMissions whereMissionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffMissions whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffMissions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StaffMissions withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffMissions withoutTrashed()
 */
	class StaffMissions extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffPunishments
 *
 * @property int $id
 * @property int|null $punishment_rule_id
 * @property int $staff_id
 * @property float $punishment
 * @property string $date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\PunishmentRules|null $punishment_rule
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffPunishments onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments wherePunishment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments wherePunishmentRuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffPunishments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StaffPunishments withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffPunishments withoutTrashed()
 */
	class StaffPunishments extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffRequests
 *
 * @property int $id
 * @property int $staff_id
 * @property string $date
 * @property string $from_time
 * @property string $to_time
 * @property string $type
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffRequests onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests whereFromTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests whereToTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRequests whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StaffRequests withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffRequests withoutTrashed()
 */
	class StaffRequests extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffRewards
 *
 * @property int $id
 * @property int $staff_id
 * @property float $days
 * @property string $date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRewards newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRewards newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffRewards onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRewards query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRewards whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRewards whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRewards whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRewards whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRewards whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRewards whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRewards whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffRewards whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StaffRewards withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffRewards withoutTrashed()
 */
	class StaffRewards extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffSalaries
 *
 * @property int $id
 * @property int $staff_id
 * @property float $salary
 * @property float $salary_per_day
 * @property string $start_date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffSalaries onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries whereSalaryPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffSalaries whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StaffSalaries withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffSalaries withoutTrashed()
 */
	class StaffSalaries extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffShifts
 *
 * @property int $id
 * @property int $staff_id
 * @property int $shift_id
 * @property string $type
 * @property string|null $date
 * @property string|null $days_string
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Shift $shift
 * @property-read \App\Models\Staff $staff
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffShifts onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts whereDaysString($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts whereShiftId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffShifts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StaffShifts withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffShifts withoutTrashed()
 */
	class StaffShifts extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StaffVacations
 *
 * @property int $id
 * @property int $staff_id
 * @property int $vacation_type_id
 * @property string $date
 * @property int $deduct
 * @property float|null $deduct_days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Staff $staff
 * @property-read \App\Models\VacationsTypes $vacation_type
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations newQuery()
 * @method static \Illuminate\Database\Query\Builder|StaffVacations onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations query()
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations whereDeduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations whereDeductDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StaffVacations whereVacationTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|StaffVacations withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StaffVacations withoutTrashed()
 */
	class StaffVacations extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property int $client_id
 * @property string $email
 * @property string $name_ar
 * @property string $name_en
 * @property string|null $code
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $start_date
 * @property string|null $commercial_registration_no
 * @property string|null $tax_registration_no
 * @property string|null $tax_file_no
 * @property string|null $tax_office
 * @property string|null $type
 * @property string|null $country
 * @property string|null $governorate
 * @property string|null $city
 * @property string|null $district
 * @property string|null $post_number
 * @property string|null $building_number
 * @property string|null $street_name
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $display_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newQuery()
 * @method static \Illuminate\Database\Query\Builder|Supplier onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereBuildingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCommercialRegistrationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereGovernorate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePostNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereStreetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereTaxFileNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereTaxOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereTaxRegistrationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Supplier withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Supplier withoutTrashed()
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TaxCategory
 *
 * @property int $id
 * @property int $type
 * @property string $name
 * @property float $tax
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCategory whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCategory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxCategory whereUpdatedAt($value)
 */
	class TaxCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TempInvoiceFooter
 *
 * @property int $id
 * @property int $temp_invoice_header_id
 * @property int $product_id
 * @property string|null $product_code
 * @property int|null $productTypeID
 * @property int|null $taxTypeID
 * @property string|null $productUnit
 * @property float|null $productQuantity
 * @property float|null $productUnitPrice
 * @property float|null $Discount
 * @property float|null $productTotalNet
 * @property float|null $productTotalTaxValue
 * @property float|null $productTaxValue
 * @property float|null $productTotalMoney
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter query()
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereProductCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereProductQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereProductTaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereProductTotalMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereProductTotalNet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereProductTotalTaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereProductTypeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereProductUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereProductUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereTaxTypeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereTempInvoiceHeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceFooter whereUpdatedAt($value)
 */
	class TempInvoiceFooter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TempInvoiceHeader
 *
 * @property int $id
 * @property int $client_id
 * @property int|null $invoiceTypeId
 * @property int|null $itemType
 * @property int|null $sectionNumID
 * @property string|null $invoiceNumber
 * @property int $customer_id
 * @property string|null $customerUniqueTaxId
 * @property string|null $customerFileNumber
 * @property string|null $CustomerAddress
 * @property string|null $customerNationalId
 * @property string|null $customerForeignId
 * @property string|null $customerMobile
 * @property string|null $invoiceDate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TempInvoiceFooter[] $footer
 * @property-read int|null $footer_count
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader query()
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereCustomerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereCustomerFileNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereCustomerForeignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereCustomerMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereCustomerNationalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereCustomerUniqueTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereInvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereInvoiceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereItemType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereSectionNumID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TempInvoiceHeader whereUpdatedAt($value)
 */
	class TempInvoiceHeader extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VacationsTypes
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $display_name
 * @method static \Illuminate\Database\Eloquent\Builder|VacationsTypes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VacationsTypes newQuery()
 * @method static \Illuminate\Database\Query\Builder|VacationsTypes onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VacationsTypes query()
 * @method static \Illuminate\Database\Eloquent\Builder|VacationsTypes whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VacationsTypes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VacationsTypes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VacationsTypes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VacationsTypes whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VacationsTypes whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VacationsTypes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|VacationsTypes withTrashed()
 * @method static \Illuminate\Database\Query\Builder|VacationsTypes withoutTrashed()
 */
	class VacationsTypes extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WareHouseLocation
 *
 * @property int $id
 * @property string $location
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseLocation whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseLocation whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseLocation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseLocation whereUpdatedAt($value)
 */
	class WareHouseLocation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Warehouse
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $warehouse_location_id
 * @property int $quantity
 * @property string|null $section
 * @property array $extra_info
 * @property \Illuminate\Support\Carbon $checked_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\WareHouseLocation|null $location
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\WarehouseFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCheckedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereExtraInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereWarehouseLocationId($value)
 */
	class Warehouse extends \Eloquent {}
}

