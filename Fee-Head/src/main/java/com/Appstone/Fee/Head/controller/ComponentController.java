package com.Appstone.Fee.Head.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import com.Appstone.Fee.Head.model.FeeComponents;
import com.Appstone.Fee.Head.service.ComponentsService;

@RestController
public class ComponentController {

	@Autowired
	private ComponentsService service;
	
	@GetMapping(path = "/AllFeeComponents")
	public  Iterable<FeeComponents> getAllFeeComponents() {
		return service.listAll();
	}
	
	@PostMapping(path = "/addFeeComponents")
	public String addNewCustomer(@RequestBody FeeComponents componnents) {
		try{
			service.save(componnents);
			} catch (Exception e) {
					return "Illegal Argument";
			}
		return "Data added";
		}
	
	@DeleteMapping("/delete/{id}")
	public String deleteProduct(@PathVariable(name = "id") int id) {
		service.delete(id);
		return "redirect:/";		
	}
}
