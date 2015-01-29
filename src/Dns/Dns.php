<?php

namespace Torreycommerce\Cloudflare;
use Torreycommerce\Cloudflare\Api;

/**
 * CloudFlare API wrapper
 *
 * DNS Record
 * CloudFlare DNS records
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Dns extends Api
{

	/**
	 * Create DNS record (permission needed: #dns_records:edit)
	 * @param  string  $zone_identifier
	 * @param  string  $type    DNS record type (A, AAAA, CNAME, TXT, SRV, LOC, MX, NS, SPF)
	 * @param  string  $name    DNS record name
	 * @param  string  $content DNS record content
	 * @param  integer $ttl     Time to live for DNS record. Value of 1 is 'automatic'
	 */
	public function create($zone_identifier, $type, $name = null, $content = null, $ttl = null)
	{
		$data = array(
			'type'    => strtoupper($type),
			'name'    => $name,
			'content' => $content,
			'ttl'     => $ttl
		);

		return $this->post('zones/' . $zone_identifier . '/dns_records', $data);
	}

	/**
	 * List DNS Records (permission needed: #dns_records:read)
	 * List, search, sort, and filter a zones' DNS records.
	 * @param  string  $zone_identifier
	 * @param  string  $type                      DNS record type (A, AAAA, CNAME, TXT, SRV, LOC, MX, NS, SPF)
	 * @param  string  $name                      DNS record name
	 * @param  string  $content                   DNS record content
	 * @param  string  $vanity_name_server_record Flag for records that were created for the vanity name server feature (true, false)
	 * @param  integer $page                      Page number of paginated results
	 * @param  integer $per_page                  Number of DNS records per page
	 * @param  string  $order                     Field to order records by (type, name, content, ttl, proxied)
	 * @param  string  $direction                 Direction to order domains (asc, desc)
	 * @param  string  $match                     Whether to match all search requirements or at least one (any) (any, all)
	 */
	public function list_records($zone_identifier, $type, $name = '', $content = '', $vanity_name_server_record = '', $page = 1, $per_page = 20, $order = '', $direction = 'desc', $match = 'all')
	{
		$data = array(
			'type'                      => $type,
			'name'                      => $name,
			'content'                   => $content,
			'vanity_name_server_record' => $vanity_name_server_record,
			'page'                      => $page,
			'per_page'                  => $per_page,
			'order'                     => $order,
			'direction'                 => $direction,
			'match'                     => $match
		);

		return $this->get('zones/' . $zone_identifier . '/dns_records', $data);
	}

	/**
	 * DNS record details (permission needed: #dns_records:read)
	 * @param  string $zone_identifier
	 * @param  string $identifier      API item identifier tag
	 */
	public function details($zone_identifier, $identifier)
	{
		return $this->get('zones/' . $zone_identifier . '/dns_records/' . $identifier);
	}

	/**
	 * Update DNS record (permission needed: #dns_records:edit)
	 * @param  string $zone_identifier
	 * @param  string $identifier      API item identifier tag
	 */
	public function update($zone_identifier, $identifier, $data)
	{
		return $this->put('zones/' . $zone_identifier . '/dns_records/' . $identifier,$data);
	}

	/**
	 * Update DNS record (permission needed: #dns_records:edit)
	 * @param  string $zone_identifier
	 * @param  string $identifier      API item identifier tag
	 */
	public function delete_record($zone_identifier, $identifier)
	{
		return $this->delete('zones/' . $zone_identifier . '/dns_records/' . $identifier);
	}

}
