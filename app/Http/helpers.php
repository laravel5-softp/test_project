<?php


if( ! function_exists('getCsvFile')){


	/**
	 * @param $fileName
	 * @return bool|resource
	 */
	function getCsvFile($fileName)
	{

		$path = public_path($fileName);
		return fopen($path, "r");
		
	}

	/**
	 * Function for error response
	 */
	if ( ! function_exists( 'errorResponse' ) ) {

		function errorResponse( $message, $statusCode )
		{
			return response()
				->json( [ 'message' => $message, 'status_code' => $statusCode ] );

		}
	}

	/**
	 * Function for success response
	 */
	if ( ! function_exists( 'successResponse' ) ) {

		function successResponse( $message )
		{
			return response()
				->json( [ 'message' => $message, 'status_code' => 200 ] );

		}
	}

}