<?php


namespace Iyngaran\RealEstate\DataTransferObjects;


use Iyngaran\Category\Repositories\CategoryRepositoryInterface;
use Spatie\DataTransferObject\DataTransferObject;
use \Iyngaran\RealEstate\Models\Contact;
use Iyngaran\RealEstate\Models\Service;
use Illuminate\Support\Facades\App;
use \Illuminate\Http\Request;

class RealEstateData extends DataTransferObject
{
    /**
     * @var string|null
     */
    public $title;

    /**
     * @var string
     */
    public $realEstateFor;

    /**
     * @var integer
     */
    public $condition;

    /**
     * @var string|null
     */
    public $country;

    /**
     * @var string|null
     */
    public $state;

    /**
     * @var string|null
     */
    public $city;

    /**
     * @var string|null
     */
    public $addressLine_1;

    /**
     * @var string|null
     */
    public $addressLine_2;

    /**
     * @var array|null
     */
    public $coordinates;

    /**
     * @var string|null
     */
    public $shortDescription;

    /**
     * @var string|null
     */
    public $detailDescription;

    /**
     * @var integer|null
     */
    public $numberOfBedrooms;

    /**
     * @var integer|null
     */
    public $numberOfBathrooms;

    /**
     * @var float|null
     */
    public $size;

    /**
     * @var string|null
     */
    public $sizeUnit;

    /**
     * @var float|null
     */
    public $age;

    /**
     * @var string|null
     */
    public $ageUnit;

    /**
     * @var float|null
     */
    public $price;

    /**
     * @var string|null
     */
    public $priceUnit;

    /**
     * @var float|null
     */
    public $minLeaseTerm;

    /**
     * @var string|null
     */
    public $minLeaseTermUnit;

    /**
     * @var double|null
     */
    public $advancedPayment;

    /**
     * @var string|null
     */
    public $advancedPaymentUnit;

    /**
     * @var string|null
     */
    public $utilityBillPaymentsIncluded;

    /**
     * @var string|null
     */
    public $negotiable;

    /**
     * @var integer|null
     */
    public $numberOfParkingSlots;

    /**
     * @var \Iyngaran\Category\Models\Category|null
     */
    public $category;

    /**
     * @var \Iyngaran\Category\Models\Category|null
     */
    public $subCategory;


    /**
     * @var \Iyngaran\RealEstate\Models\Service[]|null
     */
    public $services;

    /**
     * @var string|null
     */
    public $status;

    /**
     * @var []|null
     */
    public $defaultImage;

    /**
     * @var []\null
     */
    public $images;


    public $user;

    public static function fromRequest(Request $request): array
    {
        $serviceList = null;
        $category = null;
        $subCategory = null;
        $user = null;

        if ($services = $request->input('service_ids')) {
            $serviceList = Service::whereIn('id', $services)->get();
        }

        if ($request->input('category.id')) {
            $category = App::make(CategoryRepositoryInterface::class)->find(
                $request->input('category.id')
            );
        }

        if ($request->input('sub_category.id')) {
            $subCategory = App::make(CategoryRepositoryInterface::class)->find(
                $request->input('sub_category.id')
            );
        }

        if ($request->input('user.id')) {
            $userModel = config('iyngaran.realestate.user_model');
            $user = $userModel::find($request->input('user.id'));
        }

        return (new self(
            [
                'title' => ucfirst($request->input('title')),
                'realEstateFor' => $request->input('real_estate_for'),
                'condition' => $request->input('condition'),
                'country' => $request->input('location.country'),
                'state' => $request->input('location.state'),
                'city' => $request->input('location.city'),
                'addressLine_1' => $request->input('location.address_line_1'),
                'addressLine_2' => $request->input('location.address_line_2'),
                'coordinates' => $request->input('location.coordinates'),
                'shortDescription' => $request->input('short_description'),
                'detailDescription' => $request->input('detail_description'),
                'numberOfBedrooms' => (int)$request->input('number_of_bedrooms'),
                'numberOfBathrooms' => (int)$request->input('number_of_bathrooms'),
                'size' => (float)$request->input('size.size'),
                'sizeUnit' => $request->input('size.unit'),
                'age' => (float)$request->input('age.age'),
                'ageUnit' => $request->input('age.unit'),
                'price' => (float)$request->input('price.price'),
                'priceUnit' => $request->input('price.unit'),
                'minLeaseTerm' => (float)$request->input('min_lease_term.term'),
                'minLeaseTermUnit' => $request->input('min_lease_term.unit'),
                'advancedPayment' => (double)$request->input('advanced_payment.payment'),
                'advancedPaymentUnit' => $request->input('advanced_payment.unit'),
                'utilityBillPaymentsIncluded' => $request->input('utility_bill_payments_included'),
                'negotiable' => $request->input('negotiable'),
                'numberOfParkingSlots' => (int)$request->input('number_of_parking_slots'),
                'category' => $category,
                'subCategory' => $subCategory,
                'services' => $serviceList,
                'defaultImage' => $request->input('default_image'),
                'images' => $request->input('images'),
                'status' => $request->input('status'),
                'user' => $user
            ]
        ))->toArray();
    }

}
