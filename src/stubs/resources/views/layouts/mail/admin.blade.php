<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" style="width: 100% !important; height: 100% !important; margin: 0; padding: 0;">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>{{ config('app.name', 'Mach3Builder') }}</title>
</head>
<body bgcolor="#eff3f6" style="height: 100%; margin: 0; padding: 0; width: 100%;">

	<style type="text/css">
		.wrapper a { color: #2ea1f8; }
		.footer a { color: #7f8fa4 !important; text-decoration: underline; }
	</style>

	<table class="wrapper" bgcolor="#eff3f6" style="height: 100%; width: 100%;">
		<tr>
			<td style="height: 100%; margin: 0; padding: 0; vertical-align: top; width: 100%;">

				<table style="width: 100%;">
					<tr>
						<td style="margin: 0; padding: 54px 0 18px 0; text-align: center; vertical-align: top; width: 100%;">

							<table style="width: 100%;">
								<tr>
									<td>&nbsp;</td>
									<td bgcolor="#ffffff" style="border-bottom: 1px solid #dee2e6; color: #273142; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; margin: 0; padding: 27px; vertical-align: top; width: 600px; text-align: left;">

										@yield('content')

										<hr style="height:1px; border:none; color:#dee2e6; background-color:#dee2e6; margin: 36px 0;" />

										<table style="width: 100%; margin: 0; padding: 0;">
											<tr>
												<td style="color: #555555; font-size: 12px; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; line-height: 22px; margin: 0; padding: 0; vertical-align: top;">
													@yield('footer')
												</td>
									 		</tr>
										</table>

									</td>
									<td>&nbsp;</td>
								</tr>
							</table>

						</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
</body>
</html>
