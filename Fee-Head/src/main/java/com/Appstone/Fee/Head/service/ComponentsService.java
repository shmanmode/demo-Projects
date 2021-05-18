package com.Appstone.Fee.Head.service;

import java.util.List;
import org.springframework.stereotype.Service;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.transaction.annotation.Transactional;

import com.Appstone.Fee.Head.model.FeeComponents;
import com.Appstone.Fee.Head.repository.ComponentsRepository;

@Service
@Transactional
public class ComponentsService {

	@Autowired
	private ComponentsRepository repo;
	
	public List<FeeComponents> listAll() {
		return repo.findAll();
	}
	
	public void save(FeeComponents componnents) {
		repo.save(componnents);
	}
		
	public void delete(long id) {
		repo.deleteById(id);
	}
}
