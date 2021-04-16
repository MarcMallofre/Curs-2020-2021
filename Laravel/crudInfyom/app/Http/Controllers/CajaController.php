<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCajaRequest;
use App\Http\Requests\UpdateCajaRequest;
use App\Repositories\CajaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CajaController extends AppBaseController
{
    /** @var  CajaRepository */
    private $cajaRepository;

    public function __construct(CajaRepository $cajaRepo)
    {
        $this->cajaRepository = $cajaRepo;
    }

    /**
     * Display a listing of the Caja.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cajas = $this->cajaRepository->all();

        return view('cajas.index')
            ->with('cajas', $cajas);
    }

    /**
     * Show the form for creating a new Caja.
     *
     * @return Response
     */
    public function create()
    {
        return view('cajas.create');
    }

    /**
     * Store a newly created Caja in storage.
     *
     * @param CreateCajaRequest $request
     *
     * @return Response
     */
    public function store(CreateCajaRequest $request)
    {
        $input = $request->all();

        $caja = $this->cajaRepository->create($input);

        Flash::success('Caja saved successfully.');

        return redirect(route('cajas.index'));
    }

    /**
     * Display the specified Caja.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $caja = $this->cajaRepository->find($id);

        if (empty($caja)) {
            Flash::error('Caja not found');

            return redirect(route('cajas.index'));
        }

        return view('cajas.show')->with('caja', $caja);
    }

    /**
     * Show the form for editing the specified Caja.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $caja = $this->cajaRepository->find($id);

        if (empty($caja)) {
            Flash::error('Caja not found');

            return redirect(route('cajas.index'));
        }

        return view('cajas.edit')->with('caja', $caja);
    }

    /**
     * Update the specified Caja in storage.
     *
     * @param int $id
     * @param UpdateCajaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCajaRequest $request)
    {
        $caja = $this->cajaRepository->find($id);

        if (empty($caja)) {
            Flash::error('Caja not found');

            return redirect(route('cajas.index'));
        }

        $caja = $this->cajaRepository->update($request->all(), $id);

        Flash::success('Caja updated successfully.');

        return redirect(route('cajas.index'));
    }

    /**
     * Remove the specified Caja from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $caja = $this->cajaRepository->find($id);

        if (empty($caja)) {
            Flash::error('Caja not found');

            return redirect(route('cajas.index'));
        }

        $this->cajaRepository->delete($id);

        Flash::success('Caja deleted successfully.');

        return redirect(route('cajas.index'));
    }
}
