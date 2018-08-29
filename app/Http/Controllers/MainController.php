<?php

namespace App\Http\Controllers;

use App\Services\MainService;
use Illuminate\View\View;

class MainController extends Controller
{
    /** @var MainService $mainService */
    protected $mainService;

    /**
     * MainController constructor.
     * @param MainService $mainService
     */
    public function __construct(MainService $mainService)
    {
        $this->mainService = $mainService;
    }

    /**
     * @return View
     */
    public function numberOfRoomsAction(): View
    {
        return view('districtNumbers', $this->mainService->numberOfRooms());
    }

    /**
     * @return View
     */
    public function numberOfStoreysAction(): View
    {
        return view('districtNumbers', $this->mainService->numberOfStoreys());
    }

    /**
     * @return View
     */
    public function levelAction(): View
    {
        return view('districtNumbers', $this->mainService->level());
    }

    /**
     * @return View
     */
    public function areaAction(): View
    {
        return view('districtNumbers', $this->mainService->area());
    }

    /**
     * @return View
     */
    public function priceAction(): View
    {
        return view('static', $this->mainService->price());
    }

    /**
     * @param string|null $item
     * @return View
     */
    public function indexAction(?string $item = null): View
    {
        return view('index', $this->mainService->index($item));
    }
}
