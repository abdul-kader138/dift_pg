<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
| -----------------------------------------------------
| PRODUCT NAME: 	SCHOOL MANAGER 
| -----------------------------------------------------
| AUTHER:			MIAN SALEEM 
| -----------------------------------------------------
| EMAIL:			saleem@tecdiary.com 
| -----------------------------------------------------
| COPYRIGHTS:		RESERVED BY TECDIARY IT SOLUTIONS
| -----------------------------------------------------
| WEBSITE:			http://tecdiary.net
| -----------------------------------------------------
|
| MODULE: 			Reports
| -----------------------------------------------------
| This is reports module model file.
| -----------------------------------------------------
*/


class Reports_model extends CI_Model
{
	
	
	public function __construct()
	{
		parent::__construct();

	}
	
		
	public function getAllProducts() 
	{
		$q = $this->db->get('products');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}
	
	public function getAllUsers() 
	{
		$q = $this->db->get('users');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}
	
	public function getAllCategories() 
	{
		$q = $this->db->get('categories');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}
	
	public function getStockValue() 
	{
		$q = $this->db->query("SELECT SUM(by_price) as stock_by_price, SUM(by_cost) as stock_by_cost FROM ( Select COALESCE(sum(warehouses_products.quantity), 0)*price as by_price, COALESCE(sum(warehouses_products.quantity), 0)*cost as by_cost FROM products JOIN warehouses_products ON warehouses_products.product_id=products.id GROUP BY products.id )a");
		 if( $q->num_rows() > 0 )
		  {
			return $q->row();
		  } 
		
		  return FALSE;
	}
	
	public function getWarehouseStockValue($id) 
	{

		 $q = $this->db->query("SELECT SUM(by_price) as stock_by_price, SUM(by_cost) as stock_by_cost FROM ( Select COALESCE(sum(warehouses_products.quantity), 0)*price as by_price, COALESCE(sum(warehouses_products.quantity), 0)*cost as by_cost FROM products JOIN warehouses_products ON warehouses_products.product_id=products.id WHERE warehouses_products.warehouse_id = ? GROUP BY products.id )a", array($id));
		 if( $q->num_rows() > 0 )
		  {
			return $q->row();
		  } 
		
		  return FALSE;
	}
	
	public function getmonthlyPurchases() 
	{
		$myQuery = "SELECT (CASE WHEN date_format( date, '%b' ) Is Null THEN 0 ELSE date_format( date, '%b' ) END) as month, SUM( COALESCE( total, 0 ) ) AS purchases FROM purchases WHERE date >= date_sub( now( ) , INTERVAL 12 MONTH ) GROUP BY date_format( date, '%b' ) ORDER BY date_format( date, '%m' ) ASC";
		$q = $this->db->query($myQuery);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}
	
	public function getChartData() 
	{
		$myQuery = "SELECT S.month,
					   COALESCE(S.sales, 0) as sales,
					   COALESCE( P.purchases, 0 ) as purchases,
					   COALESCE(S.tax1, 0) as tax1,
					   COALESCE(S.tax2, 0) as tax2,
					   COALESCE( P.ptax, 0 ) as ptax
					FROM (	SELECT	date_format(date, '%Y-%m') Month,
								SUM(total) Sales,
								SUM(total_tax) tax1,
								SUM(total_tax2) tax2
						FROM sales
						WHERE sales.date >= date_sub( now( ) , INTERVAL 12 MONTH )
						GROUP BY date_format(date, '%Y-%m')) S
					LEFT JOIN (	SELECT	date_format(date, '%Y-%m') Month,
									SUM(total_tax) ptax,
									SUM(total) purchases
							FROM purchases
							GROUP BY date_format(date, '%Y-%m')) P
					ON S.Month = P.Month
					GROUP BY S.Month
					ORDER BY S.Month";
		$q = $this->db->query($myQuery);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}
	
	/*public function getDailySales() 
	{
		$year = '2013'; $month = '3';
		$myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, SUM( COALESCE( total, 0 ) ) AS sales, SUM( COALESCE( total_tax, 0 ) ) as tax1, SUM( COALESCE( total_tax2, 0 ) ) as tax2
			FROM sales
			WHERE DATE_FORMAT( date,  '%Y-%m' ) =  '2013-4'
			GROUP BY DATE_FORMAT( date,  '%e' )";
		$q = $this->db->query($myQuery);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}*/
	
	
	public function getAllWarehouses() 
	{
		$q = $this->db->get('warehouses');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}
	
	public function getAllCustomers() 
	{
		$q = $this->db->get('customers');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}
	
	public function getAllBillers() 
	{
		$q = $this->db->get('billers');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}
	
	public function getAllSuppliers() 
	{
		$q = $this->db->get('suppliers');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}
	
	public function getDailySales($year, $month) 
	{
		
		$myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, SUM( COALESCE( total_tax, 0 ) ) AS tax1, SUM( COALESCE( total_tax2, 0 ) ) AS tax2, COALESCE((SUM( COALESCE( total, 0 )) -(SUM( (COALESCE( sales_item_return.return_qty, 0 ) *COALESCE( sales_item_return.price, 0 )) )) ),0) AS total, SUM( COALESCE( inv_discount, 0 ) ) AS discount,SUM( (COALESCE( sales_item_return.return_qty, 0 ) *COALESCE( sales_item_return.price, 0 )) ) AS return_quantity
			FROM sales left join sales_item_return on sales.id=sales_item_return.sales_id
			WHERE DATE_FORMAT( date,  '%Y-%m' ) =  '{$year}-{$month}'
			GROUP BY DATE_FORMAT( date,  '%e' )";
		$q = $this->db->query($myQuery, false);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}
	
	public function getMonthlySales($year) 
	{
		
		$myQuery = "SELECT DATE_FORMAT( date,  '%c' ) AS date, SUM( COALESCE( total_tax, 0 ) ) AS tax1, SUM( COALESCE( total_tax2, 0 ) ) AS tax2, SUM( COALESCE( total, 0 ) ) AS total
			FROM sales
			WHERE DATE_FORMAT( date,  '%Y' ) =  '{$year}' 
			GROUP BY date_format( date, '%c' ) ORDER BY date_format( date, '%c' ) ASC";
		$q = $this->db->query($myQuery, false);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data;
		}
	}

    public function getAllInvoiceItemsWithDetails($sDate,$eDate)
    {

        $myQuery = "select sales.id, sale_items.product_name, sale_items.product_code, sum(sale_items.quantity) as quantity, sale_items.serial_no, sale_items.tax, sale_items.unit_price, sum(sale_items.val_tax) as val_tax, sum(sale_items.discount_val) as discount_val, sum(sale_items.gross_total) as gross_total FROM sales left join sale_items on sales.id=sale_items.sale_id WHERE sales.date between  '{$sDate}' and  '{$eDate}' GROUP BY sale_items.product_code ORDER BY sale_items.product_code ASC";
        $q = $this->db->query($myQuery, false);
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }

    public function getInvoiceBySaleID($sDate,$eDate)
    {

        $myQuery = "select sales.id as total_count ,sum(sales.total_tax2) as total_tax2,sum(sales.total_tax) as total_tax, sum(sales.inv_discount) as discount_val, sum(sales.total) as gross_total FROM sales WHERE sales.date between  '{$sDate}' and  '{$eDate}'";
        $q = $this->db->query($myQuery, false);
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }


    public function getAllInvoiceWithDetails($sDate,$eDate)
    {

        $myQuery = "select sales.id, sales.reference_no, sum(sale_items.quantity) as quantity, sale_items.tax, sale_items.unit_price, sum(sale_items.val_tax) as val_tax, sum(sale_items.discount_val) as discount_val, sum(sale_items.gross_total) as gross_total FROM sales left join sale_items on sales.id=sale_items.sale_id WHERE sales.date between  '{$sDate}' and  '{$eDate}' GROUP BY sales.reference_no ORDER BY sales.reference_no ASC";
        $q = $this->db->query($myQuery, false);
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }



    public function getBillerByID($id)
    {

        $q = $this->db->get('billers', 1);
        if( $q->num_rows() > 0 )
        {
            return $q->row();
        }

        return FALSE;

    }

    public function getBiller()
    {

        $q = $this->db->get('billers', 1);
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }

    }
}
