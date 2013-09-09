package com.omap.damkar;

import org.json.JSONArray;
import org.json.JSONException;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.telephony.TelephonyManager;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.Toast;

import com.actionbarsherlock.app.SherlockActivity;
import com.actionbarsherlock.view.Menu;
import com.actionbarsherlock.view.MenuItem;
import com.omap.damkar.data.DataManager;
import com.omap.damkar.gps.MyLocationListener;
import com.omap.damkar.model.ConfigModel;

public class MainMenu extends SherlockActivity {

	ImageView kebakaran_menu, info_menu, exit_menu;
	String locationLabelValue;
	ConfigModel model;
	String configModel_id, phone_number;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		setTitle("Menu Utama");
		super.onCreate(savedInstanceState);
		setContentView(R.layout.mainmenu);

		// Prepare database model
		model = new ConfigModel(getApplicationContext());
		try {
			JSONArray jar = new JSONArray(model.show().toString());
			if (jar.length() != 0) {
				phone_number = jar.getJSONObject(0).getString("phone_number");
				configModel_id = jar.getJSONObject(0).getString("id");
			}

		} catch (JSONException e) {
			e.printStackTrace();
		}
		System.out.println("CONFIG_MODEL_ID " + configModel_id);

		// get phone
		TelephonyManager tm = (TelephonyManager) getSystemService(MainMenu.TELEPHONY_SERVICE);
		final String deviceID = "hp_" + tm.getLine1Number();
		System.out.println("PHONE==>" + deviceID);

		if (configModel_id != null) {
			model.update(configModel_id, phone_number);
			DataManager.getData().setPhoneNumber(phone_number.substring(3));
			System.out.println("Phone Number berhasil di update");
		} else {
			model.add(deviceID);
			DataManager.getData().setPhoneNumber(deviceID.substring(3));
			System.out.println("Phone Number berhasil di simpan");
		}

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
	public boolean onCreateOptionsMenu(Menu menu) {
		menu.add(0, 0, 0, "Setting").setShowAsAction(MenuItem.SHOW_AS_ACTION_IF_ROOM);
		return true;
	}

	public boolean onOptionsItemSelected(MenuItem item) {
		Intent intent = new Intent(getApplicationContext(), Setting.class);
		startActivity(intent);
		finish();
		return true;

	}

	@Override
	public void onBackPressed() {
	}
}
