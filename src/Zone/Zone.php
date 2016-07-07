<?php

namespace Torreycommerce\Cloudflare;
use Torreycommerce\Cloudflare\Api;

/**
 * CloudFlare API wrapper
 *
 * Zone
 * A Zone is a domain name along with its subdomains and other identities
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Zone extends Api
{

	/**
	 * Create a zone (permission needed: #zone:edit)
	 * @param  string   $domain       The domain name
	 * @param  boolean  $jump_start   Automatically attempt to fetch existing DNS records
	 * @param  null     $organization Organization that this zone will belong to
	 */
	public function create($name, $jump_start = true, $organization = null)
	{
		$data = array(
			'name'         => $name,
			'jump_start'   => $jump_start,
			'organization' => $organization
		);
		return $this->post('zones', $data);
	}

	/**
	 * List zones permission needed: #zone:read
	 * List, search, sort, and filter your zones
	 * @param  string  $name      A domain name
	 * @param  string  $status    Status of the zone (active, pending, initializing, moved, deleted)
	 * @param  integer $page      Page number of paginated results
	 * @param  integer $per_page  Number of zones per page
	 * @param  string  $order     Field to order zones by (name, status, email)
	 * @param  string  $direction Direction to order zones (asc, desc)
	 * @param  string  $match     Whether to match all search requirements or at least one (any) (any, all)
	 */
	public function zones($name = '', $status = 'active', $page = 1, $per_page = 20, $order = 'status', $direction = 'desc', $match = 'all')
	{
		$data = array(
			'name'      => $name,
			'status'    => $status,
			'page'      => $page,
			'per_page'  => $per_page,
			'order'     => $order,
			//'direction' => $direction,
			'match'     => $match
		);
		return $this->get('zones', $data);
	}

	/**
	 * Zone details (permission needed: #zone:read)
	 * @param  string $identifier API item identifier tag
	 */
	public function zone($identifier)
	{
		return $this->get('zones/' . $identifier);
	}

	/**
	 * Pause all CloudFlare features (permission needed: #zone:edit)
	 * This will pause all features and settings for the zone. DNS will still resolve
	 * @param  string $identifier API item identifier tag
	 */
	public function pause($identifier)
	{
		return $this->put('zones/' . $identifier . '/pause');
	}

	/**
	 * Re-enable all CloudFlare features (permission needed: #zone:edit)
	 * This will restore all features and settings for the zone
	 * @param  string $identifier API item identifier tag
	 */
	public function unpause($identifier)
	{
		return $this->put('zones/' . $identifier . '/unpause');
	}

	/**
	 * Delete a zone (permission needed: #zone:edit)
	 * @param  string $identifier API item identifier tag
	 */
	public function delete_zone($identifier)
	{
		return $this->delete('zones/' . $identifier);
	}
    public function getSetting($identifier,$type) {
        return $this->get('zones/' . $identifier.'/settings/'.$type);
    }
    public function setSetting($identifier,$type,$value) {
        return $this->patch('zones/' . $identifier.'/settings/'.$type,['value'=>$value]);
    }    

    public function getPageRules($identifier) {
        return $this->get('zones/' . $identifier.'/pagerules/');
    }
    public function getPageRule($zoneIdentifier,$identifier) {
        return $this->get('zones/' . $zoneIdentifier.'/pagerules/'.$identifier);	
    }

    public function createPageRule($zoneIdentifier,$target,$id,$value) {
    	$arr = [ 
    		'targets'=>[ (object)
    		    [
    		        'target'=>'url',
    		        'constraint'=>(object)[ 'operator' => 'matches' , 'value' => $target ]
    		    ]
    		],
    		'actions'=>[ (object)
    			['id'=> $id, 'value' => $value]
    		],
    		'priority' => 1,
    		'status' => 'active'
     	]; 

    	return $this->post('zones/' . $zoneIdentifier.'/pagerules',$arr);	
    }
}
