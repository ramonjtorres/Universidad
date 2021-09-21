package com.monkeybit.routability;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;

import java.util.ArrayList;

public abstract class AdapterList extends BaseAdapter {
    private ArrayList<?> list;
    private int layout;
    private Context context;
    //This class is to adapt the list (ListRoute) to the view
    public AdapterList(Context context, int layout_IdView, ArrayList<?> list){
        super();
        this.context = context;
        this.list = list;
        this.layout = layout_IdView;
    }


    @Override
    public View getView(int posicion, View view, ViewGroup pariente){
        if (view == null) {
            LayoutInflater vi = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view = vi.inflate(layout, null);
        }
        onPost(list.get(posicion), view);
        return view;
    }

    @Override
    public int getCount(){
        return list.size();
    }

    @Override
    public Object getItem(int posicion){
        return list.get(posicion);
    }

    @Override
    public long getItemId(int posicion){
        return posicion;
    }

    /**
     * Return every post of the view that it´s connect
     * @param post the post that will be connected. The type of the post it´s the same of the handler
     * @param view the particular view that will have the handler's dates
     * */
    public abstract void onPost (Object post, View view);
}
