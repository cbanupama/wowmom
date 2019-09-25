<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLanguageAPIRequest;
use App\Http\Requests\API\UpdateLanguageAPIRequest;
use App\Models\Language;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LanguageController
 * @package App\Http\Controllers\API
 */

class LanguageAPIController extends AppBaseController
{
    /** @var  LanguageRepository */
    private $languageRepository;

    public function __construct(LanguageRepository $languageRepo)
    {
        $this->languageRepository = $languageRepo;
    }

    /**
     * Display a listing of the Language.
     * GET|HEAD /languages
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $languages = $this->languageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($languages->toArray(), 'Languages retrieved successfully');
    }

    /**
     * Store a newly created Language in storage.
     * POST /languages
     *
     * @param CreateLanguageAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLanguageAPIRequest $request)
    {
        $input = $request->all();

        $language = $this->languageRepository->create($input);

        return $this->sendResponse($language->toArray(), 'Language saved successfully');
    }

    /**
     * Display the specified Language.
     * GET|HEAD /languages/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Language $language */
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            return $this->sendError('Language not found');
        }

        return $this->sendResponse($language->toArray(), 'Language retrieved successfully');
    }

    /**
     * Update the specified Language in storage.
     * PUT/PATCH /languages/{id}
     *
     * @param int $id
     * @param UpdateLanguageAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLanguageAPIRequest $request)
    {
        $input = $request->all();

        /** @var Language $language */
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            return $this->sendError('Language not found');
        }

        $language = $this->languageRepository->update($input, $id);

        return $this->sendResponse($language->toArray(), 'Language updated successfully');
    }

    /**
     * Remove the specified Language from storage.
     * DELETE /languages/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Language $language */
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            return $this->sendError('Language not found');
        }

        $language->delete();

        return $this->sendResponse($id, 'Language deleted successfully');
    }
}
