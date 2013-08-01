package com.omap.damkar;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.Toast;

import com.actionbarsherlock.app.SherlockActivity;
import com.omap.damkar.gps.MyLocationListener;

public class MainMenu extends SherlockActivity {

	ImageView kebakaran_menu, info_menu, exit_menu;
	String locationLabelValue;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.mainmenu);

		// Set Location
		LocationManager mlocManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
		LocationListener mlocListener = new MyLocationListener();
		boolean isGPSEnable = mlocManager.isProviderEnabled(LocationManager.GPS_PROVIDER);
		if (isGPSEnable == true) {
			mlocManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0, 0, mlocListener);
		} else {
			mlocManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 0, 0, mlocListener);
		}

		kebakaran_menu = (ImageView) findViewById(R.id.menu_1_click);
		kebakaran_menu.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Toast.makeText(getApplicationContext(), "Kebakaran", Toast.LENGTH_LONG).show();
				Intent newIntent = new Intent(MainMenu.this, Kebakaran.class);
				startActivityForResult(newIntent, 0);
				finish();
			}
		});

		info_menu = (ImageView) findViewById(R.id.menu_2_click);
		info_menu.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Toast.makeText(getApplicationContext(), "info", Toast.LENGTH_LONG).show();
				// Intent newIntent = new Intent(MainMenu.this,
				// MapScreen.class);
				// startActivityForResult(newIntent, 0);
				// finish();
			}
		});

		exit_menu = (ImageView) findViewById(R.id.menu_3_click);
		exit_menu.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				AlertDialog.Builder alert_box = new AlertDialog.Builder(MainMenu.this);
				alert_box.setMessage("Yakin ingin Keluar..??");
				alert_box.setPositiveButton("Yes", new DialogInterface.OnClickListener() {
					@Override
					public void onClick(DialogInterface dialog, int which) {
						Toast.makeText(getApplicationContext(), "Byee!!!", Toast.LENGTH_LONG).show();
						Intent intent = new Intent(Intent.ACTION_MAIN);
						intent.addCategory(Intent.CATEGORY_HOME);
						intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
						startActivity(intent);
						finish();
					}
				});
				alert_box.setNegativeButton("No", new DialogInterface.OnClickListener() {
					@Override
					public void onClick(DialogInterface dialog, int which) {
						Toast.makeText(getApplicationContext(), "Pemikiran yang bagus..!!", Toast.LENGTH_LONG).show();
					}
				});
				alert_box.show();
			}
		});
	}

	@Override
	public void onBackPressed() {
	}
}
