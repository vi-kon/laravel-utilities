<?php
if (!function_exists('json_response'))
{
    /**
     * Return a new JSON response from the application.
     *
     * @param array $data
     * @param int   $status
     * @param array $headers
     * @param int   $options
     *
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    function json_response($data = [], $status = 200, array $headers = [], $options = 0)
    {
        $factory = app('Illuminate\Contracts\Routing\ResponseFactory');

        if (func_num_args() === 0)
        {
            return $factory;
        }

        return $factory->json($data, $status, $headers, $options);
    }
}