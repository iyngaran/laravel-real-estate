<?php


namespace Iyngaran\RealEstate\DataTransferObjects;

use Illuminate\Support\Facades\App;
use Iyngaran\Category\Repositories\CategoryRepositoryInterface;
use Iyngaran\RealEstate\Actions\CreateContactAction;
use Iyngaran\RealEstate\Models\Service;
use Iyngaran\RealEstate\Repositories\Contact\ContactRepositoryInterface;
use Spatie\DataTransferObject\DataTransferObject;
use \Iyngaran\RealEstate\Models\RealEstatePost;
use \Iyngaran\Category\Models\Category;
use \Iyngaran\RealEstate\Models\Contact;
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
     * @var \Iyngaran\RealEstate\Models\Contact|null
     */
    public $contact;

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

    public static function fromRequest(Request $request): array
    {
        $contact = null;
        $serviceList = null;

        if ($request->input('data.attributes.contact.email')) {
            if (!$contact = Contact::find($request->input('data.attributes.contact.email'))) {
                $contact = (new CreateContactAction())->execute(ContactData::fromRequest($request));
            }
        }


        if ($services = $request->input('data.attributes.service_ids')) {
            $serviceList = Service::whereIn('id', $services)->get();
        }

        $category = null;
        $subCategory = null;

        if ($request->input('data.attributes.category.id')) {
            $category = App::make(CategoryRepositoryInterface::class)->find($request->input('data.attributes.category.id'));
        }

        if ($request->input('data.attributes.sub_category.id')) {
            $subCategory = App::make(CategoryRepositoryInterface::class)->find($request->input('data.attributes.sub_category.id'));
        }


        return ( new self(
            [
                'title' => ucfirst($request->input('data.attributes.title')),
                'realEstateFor' => $request->input('data.attributes.real_estate_for'),
                'condition' => $request->input('data.attributes.condition'),
                'country' => $request->input('data.attributes.location.country'),
                'state' => $request->input('data.attributes.location.state'),
                'city' => $request->input('data.attributes.location.city'),
                'addressLine_1' => $request->input('data.attributes.location.address_line_1'),
                'addressLine_2' => $request->input('data.attributes.location.address_line_2'),
                'coordinates' => $request->input('data.attributes.location.coordinates'),
                'shortDescription' => $request->input('data.attributes.short_description'),
                'detailDescription' => $request->input('data.attributes.detail_description'),
                'numberOfBedrooms' => (int)$request->input('data.attributes.number_of_bedrooms'),
                'numberOfBathrooms' => (int)$request->input('data.attributes.number_of_bathrooms'),
                'size' => (float)$request->input('data.attributes.size.size'),
                'sizeUnit' => $request->input('data.attributes.size.unit'),
                'age' => (float)$request->input('data.attributes.age.age'),
                'ageUnit' => $request->input('data.attributes.age.unit'),
                'price' => (float)$request->input('data.attributes.price.price'),
                'priceUnit' => $request->input('data.attributes.price.unit'),
                'minLeaseTerm' => (float)$request->input('data.attributes.min_lease_term.term'),
                'minLeaseTermUnit' => $request->input('data.attributes.min_lease_term.unit'),
                'advancedPayment' => (double)$request->input('data.attributes.advanced_payment.payment'),
                'advancedPaymentUnit' => $request->input('data.attributes.advanced_payment.unit'),
                'utilityBillPaymentsIncluded' => $request->input('data.attributes.utility_bill_payments_included'),
                'negotiable' => $request->input('data.attributes.negotiable'),
                'numberOfParkingSlots' => (int)$request->input('data.attributes.number_of_parking_slots'),
                'category' => $category,
                'subCategory' => $subCategory,
                'contact' => $contact,
                'services' => $serviceList,
                'defaultImage' => $request->input('data.attributes.default_image'),
                'images' => $request->input('data.attributes.images'),
                'status' => $request->input('data.attributes.status')
            ]
        ))->toArray();
    }

}