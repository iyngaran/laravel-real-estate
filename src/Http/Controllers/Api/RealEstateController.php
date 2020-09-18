<?php


namespace Iyngaran\RealEstate\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Iyngaran\ApiResponse\Http\Traits\ApiResponse;
use Iyngaran\RealEstate\Actions\CreateRealEstatePostAction;
use Iyngaran\RealEstate\Actions\DeleteRealEstatePostAction;
use Iyngaran\RealEstate\Actions\MarkAsDraftedAction;
use Iyngaran\RealEstate\Actions\MarkAsPendingAction;
use Iyngaran\RealEstate\Actions\MarkAsPublishedAction;
use Iyngaran\RealEstate\Actions\UpdateRealEstatePostAction;
use Iyngaran\RealEstate\DataTransferObjects\RealEstateData;
use Iyngaran\RealEstate\Http\Requests\RealEstatePostRequest;
use Iyngaran\RealEstate\Http\Resources\RealEstatePost;
use Iyngaran\RealEstate\Http\Resources\RealEstatePostCollection;
use Iyngaran\RealEstate\Repositories\RealEstate\RealEstateRepositoryInterface;

class RealEstateController
{
    use ApiResponse;

    private $_realestate;

    /**
     * RealestateController constructor.
     *
     * @param RealEstateRepositoryInterface $realestate The RealEstate Repository interface
     */
    public function __construct(RealEstateRepositoryInterface $realestate)
    {
        $this->_realestate = $realestate;
    }

    /**
     * Retrieve real estate posts
     *
     * @param $request Request The http request object
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): ?JsonResponse
    {
        return $this->responseWithCollection(
            new RealEstatePostCollection($this->_realestate->search($request))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id The Realestate id
     * @return \Illuminate\Http\Response
     */
    public function show($id): ?JsonResponse
    {
        return $this->responseWithItem(
            new RealEstatePost($this->_realestate->find($id))
        );
    }

    /**
     * Create a new Realestate Post
     *
     * @param RealEstatePostRequest $request The real_estate_post request object
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RealEstatePostRequest $request): JsonResponse
    {
        return $this->createdResponse(
            new RealEstatePost((new CreateRealEstatePostAction())->execute(RealEstateData::fromRequest($request)))
        );
    }

    /**
     * Update a Realestate Post
     *
     * @param RealEstatePostRequest $request The real_estate_post request object
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RealEstatePostRequest $request, $id): JsonResponse
    {
        return $this->updatedResponse(
            new RealEstatePost((new UpdateRealEstatePostAction())->execute(RealEstateData::fromRequest($request, \Auth::user()), $id))
        );
    }

    /**
     * Delete a Realestate Post
     *
     * @param int $id The real_estate_post id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        return $this->deletedResponse(
            (new DeleteRealEstatePostAction())->execute($id)
        );
    }

    public function markAsPublished($id): JsonResponse
    {
        return $this->updatedResponse(
            new RealEstatePost((new MarkAsPublishedAction())->execute($id))
        );
    }

    public function markAsDrafted($id): JsonResponse
    {
        return $this->updatedResponse(
            new RealEstatePost((new MarkAsDraftedAction())->execute($id))
        );
    }

    public function markAsPending($id): JsonResponse
    {
        return $this->updatedResponse(
            new RealEstatePost((new MarkAsPendingAction())->execute($id))
        );
    }

}
