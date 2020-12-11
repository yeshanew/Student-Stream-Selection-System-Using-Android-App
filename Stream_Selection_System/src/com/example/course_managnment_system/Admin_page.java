package com.example.course_managnment_system;

import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;

public class Admin_page extends Activity {
	  @Override
	    protected void onCreate(Bundle savedInstanceState) {
	        super.onCreate(savedInstanceState);
	        setContentView(R.layout.activity_admin_page);
	        Button assign =(Button)findViewById(R.id.assign_btn);
	        Button register =(Button)findViewById(R.id.register_btn);
	        Button stream =(Button)findViewById(R.id.stream_btn);
	        Button detail=(Button)findViewById(R.id.detail_btn);
	        Button student_account=(Button)findViewById(R.id.account);
	        Button student_list=(Button)findViewById(R.id.list_btn);
	        Button logout=(Button)findViewById(R.id.admin_logout);
	        register.setOnClickListener(new View.OnClickListener() {
	            @Override
	            public void onClick(View view) {
	                Intent i=new Intent(getApplicationContext(),Add_user.class);
	                startActivity(i);
	            }
	        });

	       student_list.setOnClickListener(new View.OnClickListener() {
	            @Override
	            public void onClick(View view) {
	                Intent i=new Intent(getApplicationContext(),Display_studentinfo.class);
	                startActivity(i);
	            }
	        });
	       student_account.setOnClickListener(new View.OnClickListener() {
	            @Override
	            public void onClick(View view) {
	                Intent i=new Intent(getApplicationContext(),Manage_studaccount.class);
	                startActivity(i);
	            }
	        });
	        detail.setOnClickListener(new View.OnClickListener() {
	            @Override
	            public void onClick(View view) {
	               Intent i=new Intent(getApplicationContext(),Stream_detail.class);
	            
	                startActivity(i);
	            }
	        });
	        stream.setOnClickListener(new View.OnClickListener() {
	            @Override
	            public void onClick(View view) {
	               Intent i=new Intent(getApplicationContext(),Add_course.class);
	            
	                startActivity(i);
	            }
	        });
	        assign.setOnClickListener(new View.OnClickListener() {
	            @Override
	            public void onClick(View view) {
	               Intent i=new Intent(getApplicationContext(),Assign_stream.class);
	            
	                startActivity(i);
	            }
	        });
	        logout.setOnClickListener(new View.OnClickListener() {
	            @Override
	            public void onClick(View view) {
	               Intent i=new Intent(getApplicationContext(),Adminlogin_page.class);
	            
	                startActivity(i);
	            }
	        });
	    }


	    @Override
	    public boolean onCreateOptionsMenu(Menu menu) {
	    	 getMenuInflater().inflate(R.menu.admin_page, menu);
	        return true;
	    }
	    
	    @Override
	    public boolean onOptionsItemSelected(MenuItem item) {
	        int id = item.getItemId();
	        if (id == R.id.action_settings) {
	            return true;
	        }

	        return super.onOptionsItemSelected(item);
	    }
	}
