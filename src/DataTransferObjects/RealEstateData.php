<?php


namespace Iyngaran\RealEstate\DataTransferObjects;

use Illuminate\Support\Facades\App;
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
     * @var \Iyngaran\Category\Models\Category
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
    public $rent;

    /**
     * @var string|null
     */
    public $rentUnit;

    /**
     * @var float|null
     */
    public $minLeaseTerm;

    /**
     * @var string|null
     */
    public $minLeaseTermUnit;

    /**
     * @var integer|null
     */
    public $advancedPayment;

    /**
     * @var string|null
     */
    public $advancedPaymentUnit;

    /**
     * @var integer|null
     */
    public $utilityBillPaymentsIncluded;

    /**
     * @var integer|null
     */
    public $negotiable;

    /**
     * @var integer|null
     */
    public $numberOfParkingSlots;

    /**
     * @var \Iyngaran\Category\Models\Category
     */
    public $category;

    /**
     * @var \Iyngaran\Category\Models\Category
     */
    public $subCategory;

    /**
     * @var \Iyngaran\RealEstate\Models\Contact
     */
    public $contact;

    /**
     * @var \Iyngaran\RealEstate\Models\Service[]|null
     */
    public $services;



    public static function fromRequest(Request $request): array
    {
        $contact = null;
        $serviceList = null;
        //$contact = App::make(ContactRepositoryInterface::class)->findByEmail($attributes['email']);
        if (!$contact = Contact::find($request->input('data.attributes.contact.email'))) {
                $contact = (new CreateContactAction())->execute(ContactData::fromRequest($request));
        }

        if ($services = $request->input('data.attributes.service.ids')) {
            $service_ids = array_column($services, 'id');
            $serviceList =  Service::whereIn('id', $service_ids)->get();
        }

        return  (
            new self(
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
                        'numberOfBedrooms' => $request->input('data.attributes.number_of_bedrooms'),
                        'numberOfBathrooms' => $request->input('data.attributes.number_of_bathrooms'),
                        'size' => (float)$request->input('data.attributes.size.size'),
                        'sizeUnit' => $request->input('data.attributes.size.unit'),
                        'age' => (float)$request->input('data.attributes.age.age'),
                        'ageUnit' => $request->input('data.attributes.age.unit'),
                        'rent' => (float)$request->input('data.attributes.rent.rent'),
                        'rentUnit' => $request->input('data.attributes.rent.unit'),
                        'minLeaseTerm' => (float)$request->input('data.attributes.min_lease_term.term'),
                        'minLeaseTermUnit' => $request->input('data.attributes.min_lease_term.unit'),
                        'advancedPayment' => $request->input('data.attributes.advanced_payment.payment'),
                        'advancedPaymentUnit' => $request->input('data.attributes.advanced_payment.unit'),
                        'utilityBillPaymentsIncluded' => $request->input('data.attributes.utility_bill_payments_included'),
                        'negotiable' => $request->input('data.attributes.negotiable'),
                        'numberOfParkingSlots' => $request->input('data.attributes.number_of_parking_slots'),
                        'category' => Category::find($request->input('data.attributes.category.id')),
                        'subCategory' => Category::find($request->input('data.attributes.sub_category.id')),
                        'contact' => $contact,
                        'services' => $serviceList
                ]
            )
        )->toArray();
    }

}