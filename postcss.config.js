/**
 * Postcss Config.
 *
 * @package gmmb-cli
 */

module.exports = {
	plugins: [
		require( 'autoprefixer' ),
		require( 'cssnano' )(
			{
				preset: 'default',
			}
		)
	]
}
