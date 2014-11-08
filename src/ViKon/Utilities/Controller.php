<?php

namespace ViKon\Utilities;

use Illuminate\View\View;

class Controller extends \Controller
{

    /**
     * @param string[]     $rules rules for validator
     * @param mixed[]|null $input input
     *
     * @return \Illuminate\Http\RedirectResponse|null
     */
    protected function validate(array $rules, array $input = null)
    {
        if ($input === null)
        {
            $input = \Input::all();
        }

        $validator = \Validator::make($input, $rules);
        if ($validator->fails())
        {
            return \Redirect::back()->withErrors($validator)->withInput();
        }

        return null;
    }

    /**
     * @param string[]     $rules rules for validator
     * @param \Closure     $view
     * @param mixed[]|null $input
     * @param array        $data  additional data for response
     *
     * @return \Illuminate\Http\JsonResponse|null
     * @throws \Exception
     */
    protected function validateAjax(array $rules, \Closure $view, array $input = null, $data = [])
    {
        if ($input === null)
        {
            $input = \Input::all();
        }

        $validator = \Validator::make($input, $rules);
        if ($validator->fails())
        {
            \Session::flashInput(\Input::all());

            $view = $view();
            if (!$view instanceof View)
            {
                throw new \Exception('View closure have to return Illuminate\View\View object');
            }

            $content = $view->withErrors($validator->errors())->render();

            \Session::remove('_old_input');

            $data = array_merge([
                                    'success' => false,
                                    'content' => $content,
                                ],
                                $data);

            return \Response::json($data);
        }

        return null;
    }
}