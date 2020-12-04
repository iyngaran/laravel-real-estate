<?php


namespace Iyngaran\RealEstate\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Iyngaran\ApiResponse\Http\Traits\ApiResponse;
use Iyngaran\RealEstate\Http\Requests\PromotePackageRequest;
use Iyngaran\RealEstate\Http\Resources\PromotePackage as PromotePackageResource;
use Iyngaran\RealEstate\Http\Resources\PromotePackageCollection;
use Iyngaran\RealEstate\Models\PromotePackage;

class PromotePackageController
{
    use ApiResponse;

    public function index()
    {
        $promotePackages = PromotePackage::all();
        return $this->responseWithItem(new PromotePackageCollection($promotePackages));
    }

    public function promotePackage()
    {
        $promotePackages = PromotePackage::where('status', 'Enabled')->get();
        return $this->responseWithItem(new PromotePackageCollection($promotePackages));
    }

    public function store(PromotePackageRequest $request): JsonResponse
    {
        return $this->createdResponse(
            new PromotePackageResource(
                PromotePackage::create(
                    $request->only(
                        'package_name',
                        'price',
                        'short_description',
                        'detail_description',
                        'status',
                        'display_order'
                    )
                )
            )
        );
    }


    public function update(PromotePackageRequest $request, $id): JsonResponse
    {
        $promotePackage = PromotePackage::find($id);
        $promotePackage->update(
            $request->only(
                'package_name',
                'price',
                'short_description',
                'detail_description',
                'status',
                'display_order'
            )
        );
        return $this->updatedResponse(
            new PromotePackageResource($promotePackage)
        );
    }

    public function destroy($id): JsonResponse
    {
        $promotePackage = PromotePackage::find($id);
        return $this->deletedResponse($promotePackage->delete());
    }

}
